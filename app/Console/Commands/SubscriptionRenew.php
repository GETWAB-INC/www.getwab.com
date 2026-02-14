<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;
use App\Models\PaymentMethod;
use App\Models\BillingRecord;
use App\Services\TokenPaymentService;
use Carbon\Carbon;

class SubscriptionRenew extends Command
{
    protected $signature = 'subscription:renew {--limit=100} {--dry-run}';
    protected $description = 'Process due subscription renewals (charge by token)';

    /**
     * Canon policy (see 01_RENEW_POLICY.md / 02_STATE_MACHINE.md):
     * - Eligible statuses: active | past_due | suspended
     * - Success: next_billing_at = now + period (NOT anchored to old due date)
     * - First failure: status => past_due, set past_due_at/grace_until once
     * - Grace end: past_due -> suspended when now > grace_until
     * - Pending: do NOT extend period, do NOT change status, do NOT increment attempts;
     *            schedule recheck via renew_next_attempt_at
     *
     * Billing ledger:
     * - billing_records.status: Paid | Pending | Declined | Failed (canonical)
     * - Idempotency for billing_records is (user_id, flow, reference_number)
     * - payment_events.reason_code should be gateway numeric code (text goes to process_error / parsed_payload.meta)
     */

    private const GRACE_DAYS = 7;

    // Pending is not final; schedule recheck. (Policy allows 30–60m; pick 60m.)
    private const PENDING_RECHECK_SECONDS = 3600;

    public function handle(): int
    {
        $limit  = (int) $this->option('limit');
        $dryRun = (bool) $this->option('dry-run');
        $now    = Carbon::now();

        $this->info("Subscription renew started at {$now} (dry-run=" . ($dryRun ? 'yes' : 'no') . ")");

        // Eligible (canon): status IN ('active','past_due','suspended')
        $subs = Subscription::query()
            ->whereIn('status', ['active', 'past_due', 'suspended'])
            ->whereIn('plan', ['monthly', 'annual'])
            ->whereNotNull('next_billing_at')
            ->where('next_billing_at', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->whereNull('renew_next_attempt_at')
                    ->orWhere('renew_next_attempt_at', '<=', $now);
            })
            ->orderBy('next_billing_at')
            ->limit($limit)
            ->get(['id']);

        $this->info("Found {$subs->count()} subscriptions to process.");

        /** @var TokenPaymentService $svc */
        $svc = app(TokenPaymentService::class);

        foreach ($subs as $row) {
            try {

                DB::transaction(function () use ($row, $now, $dryRun, $svc) {

                /** @var Subscription|null $s */
                $s = Subscription::where('id', $row->id)->lockForUpdate()->first();
                if (!$s) return;

                // Re-check eligibility inside TX (race-safety)
                if (!in_array($s->status, ['active', 'past_due', 'suspended'], true)) return;
                if (!in_array($s->plan, ['monthly', 'annual'], true)) return;

                $nextBillingAt = $s->next_billing_at instanceof Carbon
                    ? $s->next_billing_at
                    : ($s->next_billing_at ? Carbon::parse($s->next_billing_at) : null);

                if (!$nextBillingAt || $nextBillingAt->gt($now)) return;

                $renewNextAttemptAt = $s->renew_next_attempt_at instanceof Carbon
                    ? $s->renew_next_attempt_at
                    : ($s->renew_next_attempt_at ? Carbon::parse($s->renew_next_attempt_at) : null);

                if ($renewNextAttemptAt && $renewNextAttemptAt->gt($now)) return;

                // If grace already ended, canonical escalation: past_due -> suspended.
                if ($s->status === 'past_due' && !empty($s->grace_until)) {
                    $graceUntil = $s->grace_until instanceof Carbon ? $s->grace_until : Carbon::parse($s->grace_until);
                    if ($now->gt($graceUntil)) {
                        $s->status = 'suspended';
                        $s->save();
                    }
                }

                // ===========================
                // Reference (must-have)
                // ===========================
                $cycle     = $nextBillingAt->copy()->format('YmdHi');
                $attempt   = ((int)($s->renew_attempts ?? 0)) + 1;
                $reference = "RENEW-S{$s->id}-{$cycle}";

                // ===========================
                // Extra safety: already PAID/PENDING billing record for this cycle => skip
                // ===========================
                $alreadyPaidThisCycle = BillingRecord::query()
                    ->where('user_id', $s->user_id)
                    ->where('flow', 'renew')
                    ->where('status', BillingRecord::STATUS_PAID)
                    ->where('reference_number', $reference)
                    ->exists();

                if ($alreadyPaidThisCycle) {
                    Log::channel('boa_token')->info('renew: skip (already paid this cycle)', [
                        'subscription_id' => $s->id,
                        'cycle'           => $cycle,
                    ]);
                    return;
                }

                $alreadyPendingThisCycle = BillingRecord::query()
                    ->where('user_id', $s->user_id)
                    ->where('flow', 'renew')
                    ->where('status', BillingRecord::STATUS_PENDING)
                    ->where('reference_number', $reference)
                    ->exists();

                if ($alreadyPendingThisCycle) {
                    Log::channel('boa_token')->info('renew: skip (already pending this cycle)', [
                        'subscription_id' => $s->id,
                        'cycle'           => $cycle,
                    ]);
                    return;
                }

                // ===========================
                // Idempotency guard (payment_events)
                // ✅ фикс: ok|skipped => не трогаем второй раз
                // ===========================
                $existing = DB::table('payment_events')
                    ->where('provider', 'boa')
                    ->where('flow', 'renew')
                    ->where('reference_number', $reference)
                    ->first();

                if ($existing && in_array(($existing->process_status ?? null), ['ok', 'skipped'], true)) {
                    Log::channel('boa_token')->info('renew: idempotency skip (already decided)', [
                        'subscription_id' => $s->id,
                        'reference'       => $reference,
                        'process_status'  => $existing->process_status ?? null,
                        'transaction_id'  => $existing->transaction_id ?? null,
                    ]);
                    return;
                }

                // ===========================
                // Payment method selection
                // ===========================
                $pm = PaymentMethod::getDefaultForUser((int) $s->user_id, 'boa');
                if (!$pm || !$pm->id) {
                    throw new \RuntimeException("No active payment method for user_id={$s->user_id}.");
                }
                if (!$pm->payment_instrument_id) {
                    throw new \RuntimeException("No payment_instrument_id for user_id={$s->user_id} (payment_method_id={$pm->id}).");
                }

                $amount = number_format((float) $s->amount, 2, '.', '');
                if ($amount === '0.00') {
                    throw new \RuntimeException("Subscription {$s->id} amount is 0.00 — refuse renew charge.");
                }

                if ($dryRun) {
                    Log::channel('boa_token')->info('renew: dry-run candidate', [
                        'subscription_id'   => $s->id,
                        'user_id'           => $s->user_id,
                        'reference'         => $reference,
                        'amount'            => $amount,
                        'plan'              => $s->plan,
                        'next_billing_at'   => (string)$nextBillingAt,
                        'payment_method_id' => $pm->id,
                        'attempt'           => $attempt,
                        'status'            => $s->status,
                    ]);
                    return;
                }

                // ===========================
                // 1) AUTH (server-to-server)
                // ===========================
                $auth = $svc->chargeByToken([
                    'payment_instrument_id' => $pm->payment_instrument_id,
                    'amount'                => $amount,
                    'currency'              => $s->currency ?: 'USD',
                    'reference'             => $reference,
                    'commerce_indicator'    => 'recurring',
                ]);

                $authDecision    = strtoupper((string)($auth['decision'] ?? 'ERROR'));
                $paymentId       = (string)($auth['transaction_id'] ?? '');
                $authReason      = (string)($auth['reason'] ?? ($auth['reason_code'] ?? ''));
                $authReasonCode  = $this->extractNumericReasonCode($auth);

                $authStatus = '';
                if (is_array($auth['parsed_payload'] ?? null)) {
                    $authStatus = strtoupper((string)($auth['parsed_payload']['status'] ?? ''));
                }

                // ===========================
                // 1b) CAPTURE
                // ===========================
                $capture         = null;
                $finalDecision   = $authDecision;
                $finalTxId       = $paymentId;
                $finalReasonText = $authReason !== '' ? ("AUTH: " . $authReason) : ("AUTH: " . ($authStatus ?: 'unknown'));
                $finalReasonCode = $authReasonCode;

                if ($authDecision === 'ACCEPT' && $paymentId !== '') {
                    $capture = $svc->capturePayment([
                        'payment_id' => $paymentId,
                        'amount'     => $amount,
                        'currency'   => $s->currency ?: 'USD',
                        'reference'  => $reference . '-CAP',
                    ]);

                    $capDecision = strtoupper((string)($capture['decision'] ?? 'ERROR'));
                    $capTxId     = (string)($capture['transaction_id'] ?? '');
                    $capReason   = (string)($capture['reason'] ?? ($capture['reason_code'] ?? ''));

                    $finalDecision   = $capDecision;
                    $finalTxId       = $capTxId !== '' ? $capTxId : $paymentId;
                    $finalReasonText = $capReason !== '' ? ("CAPTURE: " . $capReason) : "CAPTURE: unknown";
                    $finalReasonCode = $this->extractNumericReasonCode($capture) ?? $finalReasonCode;
                }

                $eventTxId = $finalTxId !== '' ? $finalTxId : ($paymentId !== '' ? $paymentId : ("REF:" . $reference));

                // ===========================
                // 2) payment_events upsert
                // ===========================
                $rawCombined = [
                    'auth_raw'    => $auth['raw_payload'] ?? $auth,
                    'capture_raw' => $capture ? ($capture['raw_payload'] ?? $capture) : null,
                ];
                $rawPayload = json_encode($rawCombined, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $parsedCombined = [
                    'auth'    => $auth['parsed_payload'] ?? $auth,
                    'capture' => $capture ? ($capture['parsed_payload'] ?? $capture) : null,
                    'meta'    => [
                        'reference'        => $reference,
                        'cycle'            => $cycle,
                        'attempt'          => $attempt,
                        'subscription_id'  => $s->id,
                        'user_id'          => $s->user_id,
                        'auth_status'      => $authStatus ?: null,
                        'final'            => [
                            'decision'       => $finalDecision,
                            'transaction_id' => $finalTxId ?: null,
                            'reason_text'    => $finalReasonText ?: null,
                            'reason_code'    => $finalReasonCode !== null ? (string)$finalReasonCode : null,
                            'payment_id'     => $paymentId !== '' ? $paymentId : null,
                        ],
                    ],
                ];
                $parsedPayload = json_encode($parsedCombined, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                DB::table('payment_events')->updateOrInsert(
                    [
                        'provider'         => 'boa',
                        'flow'             => 'renew',
                        'reference_number' => $reference,
                    ],
                    [
                        'transaction_id' => $eventTxId,
                        'decision'       => $finalDecision,
                        'reason_code'    => $finalReasonCode !== null ? (string)$finalReasonCode : null,
                        'amount'         => (float)$amount,
                        'currency'       => $s->currency ?: 'USD',
                        'raw_payload'    => $rawPayload,
                        'parsed_payload' => $parsedPayload,
                        'received_at'    => DB::raw('COALESCE(received_at, NOW())'),
                        'updated_at'     => $now,
                        'created_at'     => DB::raw('COALESCE(created_at, NOW())'),
                    ]
                );

                // ===========================
                // 3) billing_records upsert
                // ===========================
                $billingStatus = match ($finalDecision) {
                    'ACCEPT'   => BillingRecord::STATUS_PAID,
                    'PENDING'  => BillingRecord::STATUS_PENDING,
                    'DECLINE'  => BillingRecord::STATUS_DECLINED,
                    default    => BillingRecord::STATUS_FAILED,
                };

                $billing = BillingRecord::updateOrCreate(
                    [
                        'user_id'          => $s->user_id,
                        'flow'             => 'renew',
                        'reference_number' => $reference,
                    ],
                    [
                        'billed_at'              => $now,
                        'description'            => "Subscription renew ({$s->subscription_type} → {$s->plan})",
                        'card_last_four'         => $pm->last_four ?: '----',
                        'card_brand'             => $pm->brand ?: 'Unknown',
                        'amount'                 => $amount,
                        'currency'               => $s->currency ?: 'USD',
                        'status'                 => $billingStatus,
                        'gateway_transaction_id' => $finalTxId !== '' ? $finalTxId : ($paymentId !== '' ? $paymentId : null),
                    ]
                );

                // ===========================
                // 4) Canon state transitions
                // ===========================
                if ($finalDecision === 'ACCEPT') {
                    $newNext = match ($s->plan) {
                        'monthly' => $now->copy()->addMonthNoOverflow(),
                        'annual'  => $now->copy()->addYearNoOverflow(),
                        default   => throw new \RuntimeException("Unsupported plan for renew: {$s->plan}"),
                    };

                    $s->status             = 'active';
                    $s->billing_record_id  = $billing->id;
                    $s->payment_gateway_id = $finalTxId !== '' ? $finalTxId : ($paymentId !== '' ? $paymentId : $s->payment_gateway_id);

                    $s->expires_at      = $newNext;
                    $s->next_billing_at = $newNext;

                    $s->renew_attempts        = 0;
                    $s->renew_next_attempt_at = null;
                    $s->renew_last_error      = null;
                    $s->past_due_at           = null;
                    $s->grace_until           = null;

                    $s->save();

                    DB::table('payment_events')
                        ->where('provider', 'boa')
                        ->where('flow', 'renew')
                        ->where('reference_number', $reference)
                        ->update([
                            'process_status' => 'ok',
                            'processed_at'   => $now,
                            'process_error'  => null,
                            'updated_at'     => $now,
                        ]);

                    Log::channel('boa_token')->info('renew: ACCEPT (captured)', [
                        'subscription_id'      => $s->id,
                        'reference'            => $reference,
                        'payment_id'           => $paymentId !== '' ? $paymentId : null,
                        'final_transaction_id' => $finalTxId !== '' ? $finalTxId : null,
                        'billing_record_id'    => $billing->id,
                        'new_next_billing_at'  => (string)$newNext,
                    ]);

                    return;
                }

                if ($finalDecision === 'PENDING') {
                    $s->renew_last_error = 'PENDING';
                    $s->renew_next_attempt_at = $now->copy()->addSeconds(self::PENDING_RECHECK_SECONDS);
                    $s->save();

                    DB::table('payment_events')
                        ->where('provider', 'boa')
                        ->where('flow', 'renew')
                        ->where('reference_number', $reference)
                        ->update([
                            'process_status' => 'skipped',
                            'processed_at'   => $now,
                            'process_error'  => 'capture_pending',
                            'updated_at'     => $now,
                        ]);

                    Log::channel('boa_token')->warning('renew: PENDING (no renewal)', [
                        'subscription_id'      => $s->id,
                        'reference'            => $reference,
                        'payment_id'           => $paymentId !== '' ? $paymentId : null,
                        'final_transaction_id' => $finalTxId !== '' ? $finalTxId : null,
                        'billing_record_id'    => $billing->id,
                        'renew_next_attempt_at'=> (string)$s->renew_next_attempt_at,
                        'status'               => $s->status,
                    ]);

                    return;
                }

                // FAIL
                $attemptsBefore = (int)($s->renew_attempts ?? 0);
                $attemptsAfter  = $attemptsBefore + 1;

                $s->renew_attempts   = $attemptsAfter;
                $s->renew_last_error = $finalReasonText !== '' ? $finalReasonText : 'declined_or_error';

                if (empty($s->past_due_at)) {
                    $s->past_due_at = $now;
                }
                if (empty($s->grace_until)) {
                    $anchor = $s->past_due_at instanceof Carbon ? $s->past_due_at : Carbon::parse($s->past_due_at);
                    $s->grace_until = $anchor->copy()->addDays(self::GRACE_DAYS);
                }

                $graceUntil = $s->grace_until instanceof Carbon ? $s->grace_until : Carbon::parse($s->grace_until);
                $s->status = $now->gt($graceUntil) ? 'suspended' : 'past_due';

                $s->renew_next_attempt_at = $now->copy()->addSeconds($this->backoffSeconds($attemptsAfter));
                $s->save();

                DB::table('payment_events')
                    ->where('provider', 'boa')
                    ->where('flow', 'renew')
                    ->where('reference_number', $reference)
                    ->update([
                        'process_status' => 'error',
                        'process_error'  => $s->renew_last_error,
                        'processed_at'   => $now,
                        'updated_at'     => $now,
                    ]);

                Log::channel('boa_token')->warning('renew: FAIL (not captured)', [
                    'subscription_id'       => $s->id,
                    'reference'             => $reference,
                    'auth_decision'         => $authDecision,
                    'auth_status'           => $authStatus ?: null,
                    'payment_id'            => $paymentId !== '' ? $paymentId : null,
                    'final_decision'        => $finalDecision,
                    'final_reason_text'     => $s->renew_last_error,
                    'attempts'              => $attemptsAfter,
                    'renew_next_attempt_at' => (string)$s->renew_next_attempt_at,
                    'past_due_at'           => (string)$s->past_due_at,
                    'grace_until'           => (string)$s->grace_until,
                    'billing_record_id'     => $billing->id,
                    'status'                => $s->status,
                ]);
            });


                $this->line("Processed subscription_id={$row->id}");
            } catch (\Throwable $e) {
                Log::channel('boa_token')->error('renew: exception', [
                    'subscription_id' => $row->id,
                    'error'           => $e->getMessage(),
                ]);
                $this->error("subscription_id={$row->id} failed: " . $e->getMessage());
            }
        }

        $this->info("Subscription renew finished.");
        return self::SUCCESS;
    }

    /**
     * Canon backoff strategy (01_RENEW_POLICY.md):
     * 1 => 15m
     * 2 => 1h
     * 3 => 6h
     * 4+ => 24h
     */
    private function backoffSeconds(int $attempt): int
    {
        return match (true) {
            $attempt === 1 => 15 * 60,
            $attempt === 2 => 60 * 60,
            $attempt === 3 => 6 * 60 * 60,
            default        => 24 * 60 * 60,
        };
    }

    /**
     * payment_events.reason_code should be a numeric gateway code (canon).
     * We try to extract it from a normalized gateway response array:
     * - prefer explicit reason_code
     * - otherwise try to parse digits from reason text
     */
    private function extractNumericReasonCode($resp): ?int
    {
        if (!is_array($resp)) return null;

        $rc = $resp['reason_code'] ?? null;
        if ($rc !== null && $rc !== '') {
            if (is_int($rc)) return $rc;
            if (is_numeric($rc)) return (int)$rc;
        }

        $reason = (string)($resp['reason'] ?? '');
        if ($reason !== '') {
            if (preg_match('/\b(\d{2,6})\b/', $reason, $m)) {
                return (int)$m[1];
            }
        }

        return null;
    }
}
