<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScorersResource;
use App\Models\Competetion;
use App\Models\Scorer;

class ScorersController extends Controller
{
    public function show($id)
    {
        $competition = Competetion::find($id);
        // $scorers = DB::table('scorers')->where('comp_id', '=', $id)->get();
        // return $competition;
        // return [
        // 'competition'=>$competition,
        // 'players'=>$competition->player,
        // 'scorers'=>$scorers
        // ];
        // return $competition;
        // return $competition->clubs;
        return new ScorersResource($competition);
    }
}
