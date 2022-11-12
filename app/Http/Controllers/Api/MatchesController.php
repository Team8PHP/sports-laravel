<?php

namespace App\Http\Controllers\api;


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

        $matches = Matches::where('date', $date)->get();
        foreach($matches as $match ){
            $homeid = $match->value('home_id');
            $home = Club::find( $homeid);
            $match->homeClub = $home;
            $awayid = $match->value('away_id');
            $away = Club::find( $awayid);
            $match->awayClub = $away;
            $compid = $match->value('comp_id');
            $comp = Competetion::find( $compid);
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
