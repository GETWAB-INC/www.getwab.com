<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class SetExpired extends Command
{
    protected $signature = 'subscription:set-expired {--dry-run : Show counts only, do not update rows}';
    protected $description = 'Expire TRIAL subscriptions after trial_end_at (canonical).';

    public function handle(): int
    {
        $now = Carbon::now();
        $dryRun = (bool) $this->option('dry-run');

        // Canonical rule alignment:
        // - ONLY trials are expired by time passed.
        // - paid subscriptions (monthly/annual) are governed by renew job and are not auto-expired here.

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

        $total = $dryRun ? $trialCount : $trialUpdated;
        $this->info("Total subscriptions " . ($dryRun ? "to update" : "updated") . ": {$total}");

        return 0;
    }
}
