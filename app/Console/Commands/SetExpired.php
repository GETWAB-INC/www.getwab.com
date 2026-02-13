<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class SetExpired extends Command
{
    protected $signature = 'subscription:set-expired {--dry-run : Show counts only, do not update rows}';
    protected $description = 'Set subscription status to "expired" for trial, monthly, and annual plans if their end date (and grace) has passed';

    public function handle(): int
    {
        $now = Carbon::now();
        $dryRun = (bool) $this->option('dry-run');

        $liveStatuses = ['trial', 'active'];

        $graceExpiredFilter = function ($q) use ($now) {
            $q->whereNull('grace_until')
              ->orWhere('grace_until', '<', $now);
        };

        // =========================
        // 1) TRIAL: expire by trial_end_at (+ grace)
        // =========================
        $trialQuery = Subscription::query()
            ->whereNotNull('trial_end_at')
            ->where('trial_end_at', '<', $now)
            ->whereIn('status', $liveStatuses)
            ->where($graceExpiredFilter);

        $trialCount = (clone $trialQuery)->count();

        $trialUpdated = 0;
        if (!$dryRun && $trialCount > 0) {
            $trialUpdated = $trialQuery->update([
                'status'          => 'expired',
                'next_billing_at' => null,
                'updated_at'      => $now,
            ]);
        }

        $this->info("Trial subscriptions " . ($dryRun ? "to update" : "updated") . ": " . ($dryRun ? $trialCount : $trialUpdated));

        // =========================
        // 2) MONTHLY: expire by expires_at and plan=monthly (+ grace)
        // =========================
        $monthlyQuery = Subscription::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', $now)
            ->where('plan', Subscription::PLAN_MONTHLY)   // normalized plan
            ->whereIn('status', $liveStatuses)
            ->where($graceExpiredFilter);

        $monthlyCount = (clone $monthlyQuery)->count();

        $monthlyUpdated = 0;
        if (!$dryRun && $monthlyCount > 0) {
            $monthlyUpdated = $monthlyQuery->update([
                'status'          => 'expired',
                'next_billing_at' => null,
                'updated_at'      => $now,
            ]);
        }

        $this->info("Monthly subscriptions " . ($dryRun ? "to update" : "updated") . ": " . ($dryRun ? $monthlyCount : $monthlyUpdated));

        // =========================
        // 3) ANNUAL: expire by expires_at and plan=annual (+ grace)
        // =========================
        $annualQuery = Subscription::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', $now)
            ->where('plan', Subscription::PLAN_ANNUAL)    // normalized plan
            ->whereIn('status', $liveStatuses)
            ->where($graceExpiredFilter);

        $annualCount = (clone $annualQuery)->count();

        $annualUpdated = 0;
        if (!$dryRun && $annualCount > 0) {
            $annualUpdated = $annualQuery->update([
                'status'          => 'expired',
                'next_billing_at' => null,
                'updated_at'      => $now,
            ]);
        }

        $this->info("Annual subscriptions " . ($dryRun ? "to update" : "updated") . ": " . ($dryRun ? $annualCount : $annualUpdated));

        $total = $dryRun
            ? ($trialCount + $monthlyCount + $annualCount)
            : ($trialUpdated + $monthlyUpdated + $annualUpdated);

        $this->info("Total subscriptions " . ($dryRun ? "to update" : "updated") . ": {$total}");

        return 0;
    }
}
