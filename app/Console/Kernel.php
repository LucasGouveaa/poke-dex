<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:pokedex-command')->everyMinute()->withoutOverlapping();
    }

    protected $commands = [
        'App\Console\Commands\PokedexCommand',
    ];
}
