<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competetion extends Model
{
    use HasFactory;

    public function clubs()
    {
        return $this->belongsToMany(
            Club::class,
            'club_competition',
            'comp_id',
            'club_id'
        );
    }

    public function clubs_leagues()
    {
        return $this->belongsToMany(
            Club::class,
            'league_standings',
            'comp_id',
            'club_id'
        )->withPivot('goals', 'position');
    }

    public function clubs_groups()
    {
        return $this->belongsToMany(
            Club::class,
            'group_standings',
            'comp_id',
            'club_id'
        )->withPivot('goals', 'position','group_name');
    }

    public function player()
    {
        return $this->belongsToMany(
            Player::class,
            'scorers',
            'comp_id',
            'player_id'
        )->withPivot('goals');
    }

    public function matches(){
        return $this->hasMany('matches');
    }
}
