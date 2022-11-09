<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function leagueStandings(){
        return $this->belongsTo(LeagueStanding::class);
    }

    public function users(){
        return $this->belongsToMany(
            User::class,
            'favourites',
            'club_id',
            'user_id');
        }
}
