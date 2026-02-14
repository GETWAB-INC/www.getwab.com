<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class SetExpired extends Command
{
    protected $signature = 'subscription:set-expired {--dry-run : Show counts only, do not update rows}';
    protected $description = 'Expire TRIAL subscriptions after trial_end_at; expire PAST_DUE subscriptions after grace_until. Does NOT expire ACTIVE subscriptions by time.';

    public function handle(): int
    {
        $now = Carbon::now();
        $dryRun = (bool) $this->option('dry-run');

        // Canonical rule alignment:
        // - ACTIVE subscriptions are not expired by "time passed" (expires_at can drift / is informational).
        // - Renew job owns ACTIVE -> PAST_DUE/SUSPENDED transitions.
        // - This command only:
        //   (1) expires trial when trial_end_at passed
        //   (2) expires past_due/suspended when grace_until passed

        // =========================
        // 1) TRIAL: expire by trial_end_at (no grace concept here unless you explicitly want it)
        // =========================
        $trialQuery = Subscription::query()
            ->where('plan', 'trial')
            ->where('status', 'trial')
            ->whereNotNull('trial_end_at')
            ->where('trial_end_at', '<', $now);

        $trialCount = (clone $trialQuery)->count();

        $trialUpdated = 0;
        if (!$dryRun && $trialCount > 0) {
            $trialUpdated = $trialQuery->update([
                'status'     => 'expired',
                'updated_at' => $now,
            ]);
        }

        $this->info("Trial subscriptions " . ($dryRun ? "to update" : "updated") . ": " . ($dryRun ? $trialCount : $trialUpdated));

        // =========================
        // 2) PAST_DUE / SUSPENDED: expire when grace_until passed
        // =========================
        $graceQuery = Subscription::query()
            ->whereIn('plan', ['monthly', 'annual'])
            ->whereIn('status', ['past_due', 'suspended'])
            ->whereNotNull('grace_until')
            ->where('grace_until', '<', $now);

        $graceCount = (clone $graceQuery)->count();

        $graceUpdated = 0;
        if (!$dryRun && $graceCount > 0) {
            $graceUpdated = $graceQuery->update([
                'status'     => 'expired',
                'updated_at' => $now,
            ]);
        }

        $this->info("Past-due/suspended subscriptions " . ($dryRun ? "to update" : "updated") . ": " . ($dryRun ? $graceCount : $graceUpdated));

        $total = $dryRun
            ? ($trialCount + $graceCount)
            : ($trialUpdated + $graceUpdated);

        $this->info("Total subscriptions " . ($dryRun ? "to update" : "updated") . ": {$total}");

        return 0;
    }
}
