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
        // $scorers = Scorer::where('comp_id',$id)->get();
        // $players =Db::table('players')->where('id',"=", $scorers->value(('player_id')));
        // return $competition;
        // return [
        // 'competition'=>$competition,
        // 'players'=>$competition->players,

        // ];
        // return [
        //     'competition'=>$competition,
        //     'player'=>[$competition->player,$competition->club],
        // ];
        // return $competition->player;
        // return $competition->player;

        // return $competition->club;
        return new ScorersResource($competition);
        // return $scorers;
        // return ScorersResource::collection($competition);
    }
}
