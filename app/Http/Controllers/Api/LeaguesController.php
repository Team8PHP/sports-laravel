<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaguesResource;
use App\Models\Competetion;
use Illuminate\Http\Request;

class LeaguesController extends Controller
{
    public function index()
    {
        $leagues = Competetion::all();
        
        return LeaguesResource::collection($leagues);
    }
}
