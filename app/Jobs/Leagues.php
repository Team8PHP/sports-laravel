<?php

namespace App\Jobs;

use App\Models\Club;
use App\Models\CompClub;
use App\Models\Competetion;
use App\Models\LeagueStanding;
use App\Models\Player;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Leagues implements ShouldQueue
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
            ])->get('http://api.football-data.org/v4/competitions/'.$league);
            $newData=json_decode($data);

            $Competition=$newData;
            Competetion::updateOrCreate([
                'id'=> $Competition->id,
                'name'=> $Competition->name,
                'type'=> $Competition->type,
                'image'=> $Competition->emblem,
                'country'=> $Competition->area->name,
                'country_image'=> $Competition->area->flag,
                'current_matchday'=>$Competition->currentSeason->currentMatchday,
            ]);

            $data = Http::withHeaders([
                'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
            ])->get('http://api.football-data.org/v4/competitions/'.$league.'/teams');
            $newData=json_decode($data);
            $teams=$newData->teams;

            foreach ($teams as $team) {
                Club::updateOrCreate([
                    'name' => $team->name,
                    'id' => $team->id,
                    'tla' => $team->tla,
                    'venue' =>$team->venue,
                    'image' =>$team->crest,
                    'founded' => $team->founded,
                ]);
                CompClub::updateOrCreate([
                    'comp_id'=> $Competition->id,
                    'club_id' => $team->id,
                ]);
                $currentDate = date("Y-m-d");
                foreach ($team->squad as $player) {
                    $birthDate = $player->dateOfBirth;
                    $age = date_diff(date_create($birthDate), date_create($currentDate));
                    
                    Player::updateOrCreate([
                        'name' => $player->name,
                        'id' => $player->id,
                        'club_id' =>$team->id,
                        'position' =>$player->position,
                        'nationality' => $player->nationality,
                        'birth_date' => $player->dateOfBirth,
                        'age'=>$age->format("%y")
                    ]);
                }
            }
            $data = Http::withHeaders([
                'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
            ])->get('http://api.football-data.org/v4/competitions/'.$league.'/standings');
            $newData=json_decode($data);
            $comp_id=$newData->competition->id;
            $seasons=$newData->standings;
            $season= reset($seasons);
            foreach ($season->table as $team) {
                LeagueStanding::updateOrCreate([
                    'comp_id' => $comp_id,
                    'club_id' => $team->team->id,
                    'position' =>$team->position,
                    'goals_scored' =>$team->goalsFor,
                    'goals_against' => $team->goalsAgainst,
                    'form' => $team->form,
                    'points' => $team->points,
                    'matches_played' => $team->playedGames,
                    'wins' => $team->won,
                    'losses' => $team->lost,
                    'draws' => $team->draw,
                ]);
            }
        }
    }
}
