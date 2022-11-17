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

        return GroupStandingsResource::collection($competition->clubs_groups);
    }
}
