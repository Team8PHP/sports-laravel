<?php

namespace App\Http\Controllers\Api;

use App\Models\Competetion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupStandingsResource;

class GroupStandingsController extends Controller
{
    public function show($id)
    {
        $competition = Competetion::find($id);
        $competition->club;
        
        // $league = DB::table('group_standings')->where('comp_id', '=', $id)->get();

        // $anything= $competition->pivot->goals;
        // return [
        //     'competition'=>$competition,
        //     'league'=>$league,
        //     'club'=>$competition->clubs,
        //     // 'pivot'=>$anything,
        // ];
        // $league = LeagueStanding::find($id);

        // return $competition;
        // return LeagueStandingsResource::collection($competition->clubs);
        // return $competition->club;
        // return GroupStandingsResource::collection($competition->clubs_groups);
    }
}
