<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $leagues=['PL','SA','BL1','PD','FL1'];
        $startDate='2022-08-01';
        $endDate = '2023-06-30';
        echo "Start Seeding \n ";
        foreach ($leagues as $index=>$league) {
            if ($index%2==0) {
                sleep(60);
                echo "in sleep  \n";
            }
            seed_leagues_and_players($league);
            seed_league_standings($league);
            seed_league_scorer($league);
            seed_matches($league, $startDate, $endDate);
            echo "Done League ".$league."  \n";
        }
        $date = date('Y-m-d');
        $startDate= date('Y-m-d', strtotime('-30 days'));
        seed_news($startDate, $date);
        echo "Done News ";
    }
}
