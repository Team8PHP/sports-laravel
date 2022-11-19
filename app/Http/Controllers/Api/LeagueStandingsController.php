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
        $trial = LeagueStandingsResource::collection($competition->clubs_league)->toArray(null);
        usort($trial, function ($a, $b) {
            return $a['position'] > $b['position'];
        });
        return
            [
                "data" => $trial
            ];
    }
}
