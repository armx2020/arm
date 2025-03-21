<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:calculate-doubles')->dailyAt('00:00');
        $schedule->command('app:calculate-fullness')->dailyAt('00:00');
        $schedule->command('app:calculate-top-entities')->dailyAt('00:00');
        $schedule->command('routes:update')->dailyAt('04:00');
        $schedule->command('cache-regions')->dailyAt('04:00');
        $schedule->command('app:create-site-map --create --truncate')->dailyAt('03:00');
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
