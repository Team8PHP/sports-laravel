<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeagueStandingsResource;
use App\Models\Club;
use App\Models\LeagueStanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueStandingsController extends Controller
{
    public function show($league_id)
    {
        $league = DB::table('league_standings')->where('comp_id', '=', $league_id)->get();
        // dd($league);
        // $club = Club::find(1);
        // dd($club);

        // $league = LeagueStanding::find($league_id);

        // dd($league);
        // dd($league->club_id);

        return LeagueStandingsResource::collection($league);
    }
}
