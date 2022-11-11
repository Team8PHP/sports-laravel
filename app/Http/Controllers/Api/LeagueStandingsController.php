<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeagueStandingsResource;
use App\Models\Club;
use App\Models\Competetion;
use App\Models\LeagueStanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueStandingsController extends Controller
{
    public function show($id)
    {
        $competition = Competetion::find($id);
        // $league = DB::table('league_standings')->where('comp_id', '=', $id)->get();
        // $koko = $competition->clubs_leagues;
        // $anything= $competition->pivot->goals;
        // return [
        //     'competition'=>$competition,
        //     'league'=>$league,
        //     'club'=>$competition->clubs,
        //     // 'pivot'=>$anything,
        // ];
        // $league = LeagueStanding::find($id);
        // return $competition;
        // return $competition->club;
        // return $competition;
        // return $competition->clubs_league;
        return LeagueStandingsResource::collection($competition->clubs_league);
        // return LeagueStandingsResource::collection($competition->clubs_league);
    }
}
