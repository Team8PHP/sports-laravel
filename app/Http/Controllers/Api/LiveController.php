<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Club;
use App\Models\Competetion;

class LiveController extends Controller
{
    public function index()
    {
        $matches = Matches::where('status', 'IN_PLAY')
        ->orwhere('status', 'PAUSED')
        ->orwhere('status', 'EXTRA_TIME')
        ->orwhere('status', 'PENALTY_SHOOTOUT')
        ->orderBy('comp_id', 'DESC')
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
    }
}
