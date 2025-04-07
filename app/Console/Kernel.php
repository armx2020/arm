<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:calculate-doubles')->dailyAt('00:00');
        $schedule->command('app:calculate-fullness')->dailyAt('00:00');
        $schedule->command('app:calculate-top-entities')->dailyAt('00:00');
        $schedule->command('routes:update')->dailyAt('02:00');
        $schedule->command('cache-regions')->dailyAt('02:10');
        $schedule->command('cache-options')->dailyAt('02:20');
        $schedule->command('app:create-site-map --create --truncate')->dailyAt('03:00');

        // Обработка очереди каждую минуту
        $schedule->command('queue:work --stop-when-empty --max-time=60')
            ->everyFifteenMinutes()
            ->withoutOverlapping();

        // Очистка завершенных задач (опционально)
        $schedule->command('queue:prune-failed')->daily();
        $schedule->command('queue:prune-batches')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
