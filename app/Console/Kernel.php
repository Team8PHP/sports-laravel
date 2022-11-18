<?php

namespace App\Console;

use App\Jobs\Leagues;
use App\Jobs\Leagues_Scorers;
use App\Jobs\Matches_Filler;
use App\Jobs\NewsSeeding;
use App\Jobs\PL;
use App\Jobs\UpdateLeagueScorersStanding;
use App\Jobs\UpdateLiveMatches;
use App\Jobs\UpdateNews;
use App\Jobs\UpdateUpcomingMatches;
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
        $schedule->job(new UpdateNews())->everyThreeHours();
        $schedule->job(new UpdateLiveMatches())->everyMinute()->withoutOverlapping();
        $schedule->job(new UpdateUpcomingMatches())->daily();
        $schedule->job(new UpdateLeagueScorersStanding())->everyFiveMinutes();
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
