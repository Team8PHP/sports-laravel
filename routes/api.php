<?php

use App\Http\Controllers\api\ClubController;
use App\Http\Controllers\Api\CompetitionsController;
use App\Http\Controllers\Api\FavouritesController;
use App\Http\Controllers\Api\GroupStandingsController;
use App\Http\Controllers\Api\LeaguesController;
use App\Http\Controllers\Api\LeagueStandingsController;
use App\Http\Controllers\api\MatchesController;
use App\Http\Controllers\Api\ScorersController;
use App\Models\LeagueStanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('leagues', [LeaguesController::class,'index']);
Route::get('clubs', [ClubController::class,'index']);

Route::get('league/{id}', [LeagueStandingsController::class,'show']);

Route::get('competition/{id}', [CompetitionsController::class,'show']);

Route::get('scorers/{id}', [ScorersController::class,'show']);

Route::get('group/{id}', [GroupStandingsController::class,'show']);

Route::get('favourites/{id}', [FavouritesController::class,'show']);

Route::post('favourites', [FavouritesController::class,'store']);

Route::delete('favourites/{id}', [FavouritesController::class,'destroy']);

Route::get('matches/{date}', [MatchesController::class,'show']);
