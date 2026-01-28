<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class SetExpired extends Command
{
    protected $signature = 'subscription:set-expired';
    protected $description = 'Set subscription status to "expired" for trial, monthly, and yearly plans if their end date has passed';

    public function handle()
    {
        $now = Carbon::now();

        // 1. Проверяем триал (trial_end_at)
        $trialUpdated = Subscription::where('trial_end_at', '<', $now)
            ->where('status', '!=', 'expired')
            ->update(['status' => 'expired']);


        $this->info("Trial subscriptions updated: {$trialUpdated}");

        // 2. Проверяем месячные подписки (expires_at, тип 'Monthly')
        $monthlyUpdated = Subscription::where('expires_at', '<', $now)
            ->where('plan', 'Monthly')
            ->where('status', '!=', 'expired')
            ->update(['status' => 'expired']);


        $this->info("Monthly subscriptions updated: {$monthlyUpdated}");

        // 3. Проверяем годовые подписки (expires_at, тип 'Annual')
        $yearlyUpdated = Subscription::where('expires_at', '<', $now)
            ->where('plan', 'Annual')
            ->where('status', '!=', 'expired')
            ->update(['status' => 'expired']);

        $this->info("Annual subscriptions updated: {$yearlyUpdated}");

        $total = $trialUpdated + $monthlyUpdated + $yearlyUpdated;
        $this->info("Total subscriptions updated: {$total}");

        return 0;
    }
}