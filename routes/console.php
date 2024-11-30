<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Existing command
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Your new scheduled commands
Schedule::command('send:helloemail')->everyMinute();
Schedule::command('send:againemail')->everyMinute();
Schedule::command('send:lastemail')->everyMinute();

