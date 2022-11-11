<?php

namespace App\Jobs;

use App\Models\Scorer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Leagues_Scorers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $leagues=['PL','SA','BL1','PD','FL1'];
        foreach ($leagues as $league) {
            $data = Http::withHeaders([
                'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
            ])->get('http://api.football-data.org/v4/competitions/'.$league.'/scorers?limit=8');
            $newData=json_decode($data);

            $scorers=$newData->scorers;
            $comp_id=$newData->competition->id;
            foreach($scorers as $scorer){
                Scorer::updateOrCreate([
                    'player_id'=> $scorer->player->id,
                    'comp_id'=> $comp_id,
                    'goals'=> $scorer->goals,
                ]);
            }

        }
    }
}