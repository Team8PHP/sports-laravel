<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClubsResource;
use App\Models\Club;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $club = Club::all();

        return  ClubsResource::collection($club);
    }

    public function show($id)
    {
        $club = Club::find($id);
        return new  ClubsResource($club);
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
