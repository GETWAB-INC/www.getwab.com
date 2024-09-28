<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Пример для команд, которые работают только с 9:00 до 18:00 по времени UTC-5
        $schedule->command('send:helloemail')
            ->everyMinute()
            ->timezone('America/New_York') // Устанавливаем часовой пояс Восточного времени США (UTC-5)
            ->between('9:00', '18:00');    // Рабочие часы с 9:00 до 18:00

        $schedule->command('send:againemail')
            ->everyMinute()
            ->timezone('America/New_York')
            ->between('9:00', '18:00');

        $schedule->command('send:lastemail')
            ->everyMinute()
            ->timezone('America/New_York')
            ->between('9:00', '18:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
