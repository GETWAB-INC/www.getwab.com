<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Existing command
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// 1) Renew orchestrator (monthly/annual renewals + retries)
Schedule::command('subscription:renew --limit=200')
    ->everyMinute()
    ->withoutOverlapping(10)          // prevents two runs at once (10 min lock)
    ->runInBackground();             // optional

// 2) Expire trials only
Schedule::command('subscription:set-expired')
    ->everyFifteenMinutes()
    ->withoutOverlapping(10)
    ->runInBackground();             // optional
