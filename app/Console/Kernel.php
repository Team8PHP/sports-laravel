<?php

namespace App\Console;

use App\Jobs\Leagues;
use App\Jobs\Leagues_Scorers;
use App\Jobs\Matches_Filler;
use App\Jobs\NewsSeeding;
use App\Jobs\PL;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->job(new Leagues());
        // $schedule->job(new Leagues_Scorers());
        // $schedule->job(new Matches_Filler());
        // $schedule->job(new NewsSeeding());
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
