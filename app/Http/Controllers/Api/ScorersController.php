<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScorersResource;

class ScorersController extends Controller
{
    public function show($id)
    {
        $scorers = DB::table('scorers')->where('comp_id', '=', $id)->get();

        return ScorersResource::collection($scorers);
    }
}
