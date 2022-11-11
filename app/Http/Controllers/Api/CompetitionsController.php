<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompetitionsResource;
use App\Models\Competetion;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    public function show($id)
    {
        $competition = Competetion::find($id);
        return new CompetitionsResource($competition);
    }
}
