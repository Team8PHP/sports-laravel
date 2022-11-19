<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Matches;
use App\Models\Club;
use App\Models\Competetion;

class MatchesController extends Controller
{
    public function show($date)
    {
        $matches = Matches::where('date', $date)->orderBy('comp_id', 'DESC')
        ->orderBy('time', 'ASC')
        ->get();

        foreach ($matches as $match) {
            $homeid = $match->home_id;
            $home = Club::find($homeid);
            $match->homeClub = $home;
            $awayid = $match->away_id;
            $away = Club::find($awayid);
            $match->awayClub = $away;
            $compid = $match->comp_id;
            $comp = Competetion::find($compid);
            $match->comp = $comp;
        }
        return [
        'match'=>$matches
        // ,'homeClub'=>$match->homeClub
        // ,'awayclub'=>$match->awayClub
        // ,'comp'=>$match->comp
    ];
        // $home=$match->home_id;
        // return  MatchResource::collection($match,$home);
    }
}
