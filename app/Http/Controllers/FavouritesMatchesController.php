<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Club;
use App\Models\Competetion;
use App\Models\favourite;
use App\Models\User;

class FavouritesMatchesController extends Controller
{
    
    public function show($userid,$date)
    {
        $userclubs=User::find($userid)->clubs;
    $matchestotal= [];
        foreach($userclubs as $club){
            $clubid= $club->Id;
            $matches = Matches::where('date', $date)->where('home_id', '=', $clubid)
            ->orwhere('date', $date)->where('away_id', '=', $clubid)->get();
            foreach($matches as $match ){
                $homeid = $match->home_id;
                $home = Club::find( $homeid);
                $match->homeClub = $home;
                $awayid = $match->away_id;
                $away = Club::find( $awayid);
                $match->awayClub = $away;
                $compid = $match->comp_id;
                $comp = Competetion::find($compid);
                $match->comp = $comp;
                array_push($matchestotal,$match);
            }
        }
        
        return [
         'match'=> $matchestotal
    ];

    // return $clubid;
}
}