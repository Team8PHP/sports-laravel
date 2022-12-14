<?php

namespace App\Http\Controllers\Api;

use App\Models\Club;
use App\Models\User;
use App\Models\favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClubsResource;
use App\Http\Resources\FavouritesResource;

class FavouritesController extends Controller
{
    public function show($user_id)
    {
        $user = User::find($user_id);


        // return new FavouritesResource($user);
        return FavouritesResource::collection($user->clubs);
    }

    public function store()
    {
        $favorite = favourite::create([
            'user_id' => request()->user_id,
            'club_id' => request()->club_id,
        ]);
        return $favorite;
    }

    public function destroy($id)
    {
        $favorite = Favourite::find($id);
        $favorite->delete();
        return $favorite;
    }
    public function destroybyuser($userid,$clubid)
    {
        // return[$userid,$clubid];
        $favorite = Favourite::where('user_id','=',$userid)->where('club_id','=',$clubid)->delete();
        // ->where('club_id','=',$clubid);
        // return $favorite;
        // $favorite->delete();
        return $favorite;
    }
}
