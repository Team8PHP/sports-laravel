<?php

use App\Models\Club;
use App\Models\CompClub;
use App\Models\Competetion;
use App\Models\LeagueStanding;
use App\Models\Matches;
use App\Models\News;
use App\Models\Player;
use App\Models\Scorer;
use Illuminate\Support\Facades\Http;

if (!function_exists('store_news')) {
    function store_news($articles)
    {
        foreach ($articles as $article) {
            $articleDate= date('Y-m-d', strtotime($article->publishedAt));
            $articleTime = date('H:i', strtotime($article->publishedAt));
            $articleContent= substr($article->content, 0, 199);
            News::updateOrCreate(
                ['url'=> $article->url],
                [
                   'source'=> $article->source->name,
                   'author'=> $article->author,
                   'description'=> $article->description,
                   'content'=> utf8_encode($articleContent),
                   'date'=> $articleDate,
                   'time'=>$articleTime,
                   'title'=> $article->title,
                   'urlToImage'=> $article->urlToImage,
            ]
            );
        }
        return "done";
    }
}

if (!function_exists('seed_news')) {
    function seed_news($startDate, $endDate)
    {
        $page=1;
        $data = Http::withHeaders([
            'X-Api-Key' => 'c12781e9fcfa49678f88b6a79574bed0',
        ])->get('https://newsapi.org/v2/everything/?sources=four-four-two&from='.$startDate.'&to='.$endDate.'&page='.$page);

        $newData=json_decode($data);
        $articles=$newData->articles;
        store_news($articles);
        $numOfPages=(int) ($newData->totalResults /100);
        if ($newData->totalResults % 100) {
            $numOfPages++;
        }
        if ($numOfPages>1) {
            for ($count=2; $count<=$numOfPages;$count++) {
                $data = Http::withHeaders([
                    'X-Api-Key' => 'c12781e9fcfa49678f88b6a79574bed0',
                ])->get('https://newsapi.org/v2/everything/?sources=four-four-two&from='.$startDate.'&to='.$endDate.'&page='.$count);
                $newData=json_decode($data);
                $articles=$newData->articles;
                store_news($articles);
            }
        }
    }
}

if (!function_exists('seed_leagues_and_players')) {
    function seed_leagues_and_players($league)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
        ])->get('http://api.football-data.org/v4/competitions/'.$league);
        $newData=json_decode($data);
        $Competition=$newData;
        Competetion::updateOrCreate([
            'id'=> $Competition->id,
        ], [
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
        $currentDate = date("Y-m-d");
        foreach ($teams as $team) {
            Club::updateOrCreate([
                'id' => $team->id,
            ], [
                'name' => $team->name,
                'tla' => $team->tla,
                'venue' =>$team->venue,
                'image' =>$team->crest,
                'founded' => $team->founded,
                'country_name' => $team->area->name,
                'country_image' => $team->area->flag,

            ]);
            CompClub::updateOrCreate([
                'comp_id'=> $Competition->id,
                'club_id' => $team->id,
            ]);
            foreach ($team->squad as $player) {
                $birthDate = $player->dateOfBirth;
                $age = date_diff(date_create($birthDate), date_create($currentDate));
                Player::updateOrCreate([
                    'id' => $player->id,
                ], [
                    'name' => $player->name,
                    'club_id' =>$team->id,
                    'position' =>$player->position,
                    'nationality' => $player->nationality,
                    'birth_date' => $player->dateOfBirth,
                    'age'=>$age->format("%y")
                ]);
            }
        }
    }
}

if (!function_exists('seed_league_standings')) {
    function seed_league_standings($league)
    {
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
            ], [
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


if (!function_exists('seed_league_scorer')) {
    function seed_league_scorer($league)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
        ])->get('http://api.football-data.org/v4/competitions/'.$league.'/scorers?limit=8');
        $newData=json_decode($data);

        $scorers=$newData->scorers;
        $comp_id=$newData->competition->id;
        foreach ($scorers as $scorer) {
            $id=$scorer->player->id ;
            if ($league == 'SA' && $scorer->player->id == 161370) {
                $id=3011;
            }
            Scorer::updateOrCreate([
                'player_id'=> $id,
                'comp_id'=> $comp_id,
            ], [
                'goals'=> $scorer->goals,
            ]);
        }
    }
}

if (!function_exists('seed_matches')) {
    function seed_matches($league, $startDate, $endDate)
    {
        $data = Http::withHeaders([
            'X-Auth-Token' => 'b0a3cc6c6af44139bb0fa3f11ae1f2ec',
        ])->get('http://api.football-data.org/v4/competitions/'.$league.'/matches?dateTo='.$endDate.'&dateFrom='.$startDate);
        $newData=json_decode($data);
        $matches= $newData->matches;
        foreach ($matches as $match) {
            $matchDate= date('Y-m-d', strtotime($match->utcDate));
            $matchTime = date('H:i', strtotime($match->utcDate));
            Matches::updateOrCreate(['id' => $match->id,], [
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
