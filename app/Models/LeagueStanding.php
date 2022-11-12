<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'comp_id',
        'club_id',
        'position',
        'goals_scored',
        'goals_against',
        'form',
        'matches_played',
        'wins',
        'losses',
        'draws',
        "points",
    ];
}
