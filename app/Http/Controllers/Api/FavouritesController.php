<?php

namespace App\Http\Controllers\Api;

use App\Models\Club;
use App\Models\User;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClubsResource;
use App\Http\Resources\FavouritesResource;

class FavouritesController extends Controller
{
    public function show($user_id)
    {
//         $user = User::find($user_id);
//         dd($user->favourites);
//         dd($user);
//         dd($user->favourites);

        // return FavouritesResource::collection($user->favourites);
    }
}
