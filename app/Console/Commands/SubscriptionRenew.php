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
        $limit = (int)$this->option('limit');
        $dryRun = (bool)$this->option('dry-run');
        $now = Carbon::now();

        $this->info("Subscription renew started at {$now} (dry-run=" . ($dryRun ? 'yes' : 'no') . ")");

        $subs = Subscription::query()
            ->where('status', 'active')
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

        $svc = app(TokenPaymentService::class);

        foreach ($subs as $row) {
            try {
                DB::transaction(function () use ($row, $now, $dryRun, $svc) {

                    /** @var Subscription $s */
                    $s = Subscription::where('id', $row->id)->lockForUpdate()->first();
                    if (!$s) return;

                    // re-check in tx
                    if ($s->status !== 'active') return;
                    if (!in_array($s->plan, ['monthly', 'annual'], true)) return;
                    if (!$s->next_billing_at || $s->next_billing_at->gt($now)) return;
                    if ($s->renew_next_attempt_at && $s->renew_next_attempt_at->gt($now)) return;

                    // idempotency reference for this billing cycle
                    $cycle = $s->next_billing_at->format('Ymd'); // stable
                    $reference = "RENEW-S{$s->id}-{$cycle}";

                    // (optional) hard idempotency via payment_events if table exists
                    // If you have payment_events: uncomment and add schema accordingly.
                    // $inserted = DB::table('payment_events')->insertOrIgnore([...]);
                    // if ($inserted === 0) return;

                    $pm = PaymentMethod::getDefaultForUser((int)$s->user_id, 'boa');

                    $amount = number_format((float)$s->amount, 2, '.', '');
                    if ($amount === '0.00') {
                        // safety: prevent silent free renew in production
                        throw new \RuntimeException("Subscription {$s->id} amount is 0.00 — refuse renew charge.");
                    }

                    if ($dryRun) {
                        Log::channel('boa_token')->info('renew: dry-run candidate', [
                            'subscription_id' => $s->id,
                            'user_id' => $s->user_id,
                            'reference' => $reference,
                            'amount' => $amount,
                            'plan' => $s->plan,
                            'next_billing_at' => (string)$s->next_billing_at,
                            'payment_method_id' => $pm->id,
                        ]);
                        return;
                    }

                    $result = $svc->chargeByToken([
                        'payment_instrument_id' => $pm->payment_instrument_id,
                        'amount' => $amount,
                        'currency' => $s->currency ?: 'USD',
                        'reference' => $reference,
                        'commerce_indicator' => 'recurring',
                    ]);

                    // billing record (Paid/Declined/Failed)
                    $status = match ($result['decision'] ?? 'ERROR') {
                        'ACCEPT' => 'completed',
                        'DECLINE' => 'cancelled', // or 'declined' if you have it
                        default => 'pending', // or 'failed'
                    };

                    BillingRecord::create([
                        'user_id' => $s->user_id,
                        'billed_at' => $now,
                        'description' => "Subscription renew ({$s->subscription_type} → {$s->plan})",
                        'card_last_four' => $pm->last_four ?? $pm->last_four ?? null,
                        'card_brand' => $pm->brand ?? $pm->brand ?? null,
                        'amount' => $amount,
                        'currency' => $s->currency ?: 'USD',
                        'status' => $status,
                        'gateway_transaction_id' => $result['transaction_id'] ?? null,
                    ]);

                    // Update subscription according to decision
                    if (($result['decision'] ?? null) === 'ACCEPT') {
                        $newNext = $s->calculateNextBillingDate(); // uses expires_at as base
                        $s->expires_at = $newNext;
                        $s->next_billing_at = $newNext;

                        // reset retry fields
                        $s->renew_attempts = 0;
                        $s->renew_next_attempt_at = null;
                        $s->renew_last_error = null;
                        $s->past_due_at = null;
                        $s->grace_until = null;

                        $s->save();

                        Log::channel('boa_token')->info('renew: ACCEPT', [
                            'subscription_id' => $s->id,
                            'reference' => $reference,
                            'transaction_id' => $result['transaction_id'] ?? null,
                            'new_next_billing_at' => (string)$newNext,
                        ]);

                        return;
                    }

                    // DECLINE/ERROR => retry/backoff/grace
                    $attempts = (int)($s->renew_attempts ?? 0);
                    $attempts++;
                    $s->renew_attempts = $attempts;
                    $s->renew_last_error = (string)($result['reason'] ?? 'declined_or_error');
                    $s->past_due_at = $s->past_due_at ?: $now;

                    $s->renew_next_attempt_at = $now->copy()->addSeconds($this->backoffSeconds($attempts));
                    $s->grace_until = $now->copy()->addDays(7);

                    $s->save();

                    Log::channel('boa_token')->warning('renew: NOT ACCEPT', [
                        'subscription_id' => $s->id,
                        'reference' => $reference,
                        'decision' => $result['decision'] ?? null,
                        'reason' => $result['reason'] ?? null,
                        'attempts' => $attempts,
                        'renew_next_attempt_at' => (string)$s->renew_next_attempt_at,
                        'grace_until' => (string)$s->grace_until,
                    ]);
                });

                $this->line("Processed subscription_id={$row->id}");
            } catch (\Throwable $e) {
                Log::channel('boa_token')->error('renew: exception', [
                    'subscription_id' => $row->id,
                    'error' => $e->getMessage(),
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
            default => 72 * 3600,
        };
    }
}
