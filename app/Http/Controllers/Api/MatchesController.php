<?php

namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Matches;

class MatchesController extends Controller
{   public function show($date){

    $match = Matches::where('date',$date)->with('competetion')->get();
    return $match;
}
}
