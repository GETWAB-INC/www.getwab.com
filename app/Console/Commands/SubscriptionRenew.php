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

    public function handle(): int
    {
        $limit  = (int) $this->option('limit');
        $dryRun = (bool) $this->option('dry-run');
        $now    = Carbon::now();

        $this->info("Subscription renew started at {$now} (dry-run=" . ($dryRun ? 'yes' : 'no') . ")");

        // IMPORTANT:
        // - We must also process "suspended" subscriptions to allow retries.
        $subs = Subscription::query()
            ->whereIn('status', ['active', 'suspended'])
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
                    if (!$s) {
                        return;
                    }

                    // Re-check inside tx (safety against races)
                    if (!in_array($s->status, ['active', 'suspended'], true)) return;
                    if (!in_array($s->plan, ['monthly', 'annual'], true)) return;

                    $nextBillingAt = $s->next_billing_at instanceof Carbon
                        ? $s->next_billing_at
                        : ($s->next_billing_at ? Carbon::parse($s->next_billing_at) : null);

                    if (!$nextBillingAt || $nextBillingAt->gt($now)) return;

                    $renewNextAttemptAt = $s->renew_next_attempt_at instanceof Carbon
                        ? $s->renew_next_attempt_at
                        : ($s->renew_next_attempt_at ? Carbon::parse($s->renew_next_attempt_at) : null);

                    if ($renewNextAttemptAt && $renewNextAttemptAt->gt($now)) return;

                    // ===========================
                    // Reference (must-have)
                    // - minute precision YmdHi
                    // - include attempt suffix to avoid collisions across retries
                    // ===========================
                    $cycle = $nextBillingAt->copy()->format('YmdHi');
                    $attemptForReference = ((int)($s->renew_attempts ?? 0)) + 1;
                    $reference = "RENEW-S{$s->id}-{$cycle}-A{$attemptForReference}";

                    // ===========================
                    // Extra safety guard:
                    // If we already have a PAID billing record for THIS cycle (any attempt) => skip
                    // ===========================
                    $alreadyPaidThisCycle = BillingRecord::query()
                        ->where('user_id', $s->user_id)
                        ->where('flow', 'renew')
                        ->where('status', 'Paid')
                        ->where('reference_number', 'like', "RENEW-S{$s->id}-{$cycle}-%")
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
                        ->where('status', 'Pending')
                        ->where('reference_number', 'like', "RENEW-S{$s->id}-{$cycle}-%")
                        ->exists();

                    if ($alreadyPendingThisCycle) {
                        Log::channel('boa_token')->info('renew: skip (already pending this cycle)', [
                            'subscription_id' => $s->id,
                            'cycle'           => $cycle,
                        ]);
                        return;
                    }


                    // ===========================
                    // Idempotency guard:
                    // skip ONLY if already processed successfully (process_status='ok')
                    // allow retry if process_status='error' or record missing
                    // ===========================
                    $existing = DB::table('payment_events')
                        ->where('provider', 'boa')
                        ->where('flow', 'renew')
                        ->where('reference_number', $reference)
                        ->first();

                    if ($existing && ($existing->process_status ?? null) === 'ok') {
                        Log::channel('boa_token')->info('renew: idempotency skip (already ok)', [
                            'subscription_id' => $s->id,
                            'reference'       => $reference,
                            'transaction_id'  => $existing->transaction_id ?? null,
                        ]);
                        return;
                    }

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
                            'next_billing_at'   => (string) $nextBillingAt,
                            'payment_method_id' => $pm->id,
                            'attempt'           => $attemptForReference,
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

                    $authDecision = strtoupper((string)($auth['decision'] ?? 'ERROR'));
                    $paymentId    = (string)($auth['transaction_id'] ?? ''); // paymentId from PTS
                    $authReason   = (string)($auth['reason'] ?? ($auth['reason_code'] ?? ''));

                    $authStatus = '';
                    if (is_array($auth['parsed_payload'] ?? null)) {
                        $authStatus = strtoupper((string)($auth['parsed_payload']['status'] ?? ''));
                    }

                    // ===========================
                    // 1b) CAPTURE (real charge)
                    // ===========================
                    $capture       = null;
                    $finalDecision = $authDecision;
                    $finalTxId     = $paymentId;
                    $finalReason   = $authReason !== '' ? ("AUTH: " . $authReason) : ("AUTH: " . ($authStatus ?: 'unknown'));

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

                        $finalDecision = $capDecision;
                        $finalTxId     = $capTxId !== '' ? $capTxId : $paymentId;
                        $finalReason   = $capReason !== '' ? ("CAPTURE: " . $capReason) : "CAPTURE: unknown";
                    }

                    // payment_events.transaction_id is NOT NULL in your schema -> always provide something deterministic.
                    $eventTxId = $finalTxId !== '' ? $finalTxId : ($paymentId !== '' ? $paymentId : ("REF:" . $reference));

                    // ===========================
                    // 2) payment_events (flow=renew) — upsert
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
                            'auth_status'      => $authStatus ?: null,
                            'reference'        => $reference,
                            'cycle'            => $cycle,
                            'attempt'          => $attemptForReference,
                            'subscription_id'  => $s->id,
                            'user_id'          => $s->user_id,
                            'final'            => [
                                'decision'       => $finalDecision,
                                'transaction_id' => $finalTxId ?: null,
                                'reason'         => $finalReason ?: null,
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
                            'reason_code'    => $finalReason !== '' ? $finalReason : null,
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
                    // 3) billing_records — upsert
                    // ===========================
                    $billingStatus = match ($finalDecision) {
                        'ACCEPT'   => 'Paid',
                        'PENDING'  => 'Pending',
                        'DECLINE'  => 'Declined',
                        default    => 'Failed',
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
                            'card_last_four'         => $pm->last_four ?: null,
                            'card_brand'             => $pm->brand ?: null,
                            'amount'                 => $amount,
                            'currency'               => $s->currency ?: 'USD',
                            'status'                 => $billingStatus,
                            'gateway_transaction_id' => $finalTxId !== '' ? $finalTxId : ($paymentId !== '' ? $paymentId : null),
                        ]
                    );

                    // ===========================
                    // 4) Update subscription according to CAPTURE result
                    // ===========================
                    if ($finalDecision === 'ACCEPT') {

                    // POLICY: strict anchor to original due date
                    // NEVER use now() as base
                    $base = $nextBillingAt->copy();

                    $newNext = match ($s->plan) {
                        'monthly' => $base->copy()->addMonthNoOverflow(),
                        'annual'  => $base->copy()->addYearNoOverflow(),
                        default   => throw new \RuntimeException("Unsupported plan for renew: {$s->plan}"),
                    };


                        // ✅ success => active + reset fields (must-have)
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
                        ]);

                        return;
                    }


                    // ===========================
                    // DECLINE/ERROR => retry/backoff/grace + status rules (must-have)
                    // ===========================
                    $attemptsBefore = (int)($s->renew_attempts ?? 0);
                    $attemptsAfter  = $attemptsBefore + 1;

                    $isFirstFail = ($attemptsAfter === 1);

                    $s->renew_attempts   = $attemptsAfter;
                    $s->renew_last_error = $finalReason !== '' ? $finalReason : 'declined_or_error';

                    // ✅ past_due/grace фиксируем только на первом фейле (не двигаем на ретраях)
                    if (empty($s->past_due_at)) {
                        $s->past_due_at = $now;
                    }
                    if (empty($s->grace_until)) {
                        $anchor = $s->past_due_at instanceof Carbon ? $s->past_due_at : Carbon::parse($s->past_due_at);
                        $s->grace_until = $anchor->copy()->addDays(7);
                    }

                    // ✅ первый фейл: suspended только если был active
                    if ($isFirstFail && $s->status === 'active') {
                        $s->status = 'suspended';
                    }

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

                    Log::channel('boa_token')->warning('renew: NOT ACCEPT (not captured)', [
                        'subscription_id'       => $s->id,
                        'reference'             => $reference,
                        'auth_decision'         => $authDecision,
                        'auth_status'           => $authStatus ?: null,
                        'payment_id'            => $paymentId !== '' ? $paymentId : null,
                        'final_decision'        => $finalDecision,
                        'final_reason'          => $s->renew_last_error,
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

    private function backoffSeconds(int $attempt): int
    {
        return match (true) {
            $attempt === 1 => 6 * 3600,
            $attempt === 2 => 24 * 3600,
            $attempt === 3 => 72 * 3600,
            default        => 72 * 3600,
        };
    }
}
