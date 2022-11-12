<?php

namespace App\Jobs;

use App\Models\Matches;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Matches_Filler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        // $leagues=['PL'];
        foreach ($leagues as $league) {
            $data = Http::withHeaders([
                'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
            ])->get('http://api.football-data.org/v4/competitions/'.$league.'/matches?dateTo=2022-11-20&dateFrom=2022-11-01');
            $newData=json_decode($data);
            $matches= $newData->matches;
            foreach ($matches as $match) {
                $matchDate= date('Y-m-d', strtotime($match->utcDate));
                $matchTime = date('H:i', strtotime($match->utcDate));
                Matches::updateOrCreate([
                    'Id' => $match->id,
                    'status' => $match->status,
                    'matchday' => $match->matchday,
                    "comp_id" => $match->competition->id,
                    'date' => $matchDate,
                    'time' => $matchTime,
                    'stage' => $match->stage,
                    'home_id' =>$match->homeTeam->id,
                    'away_id' =>$match->awayTeam->id,
                    'home_score' => $match->score->fullTime->home,
                    'away_score' => $match->score->fullTime->away,
                ]);
            }
        }
    }
}
