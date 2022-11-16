<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClubsResource;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $club = Club::all();
        // return $club;

        return  ClubsResource::collection($club);
    }
    public function searchClub(Request $request) {
        $query = Club::query();
        $data = $request->input('search_club');
        if($data){
            $query->whereRaw("name LIKE '%" .$data. "%'");
        }
        return $query->get();
    }

}
