<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competetion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image',
        'type',
        'country',
        'country_image',
        'current_matchday'
    ];

    public function club()
    {
        return $this->belongsToMany(
            Club::class,
            "comp_club",
            "comp_id",
            "club_id"
        );
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

    public function clubs_groups()
    {
        return $this->belongsToMany(
            Club::class,
            'group_standings',
            'comp_id',
            'club_id'
        )->withPivot('position', 'group_name', 'goals_scored', 'goals_against', 'form', 'matches_played', 'wins', 'losses', 'draws', 'points');
    }

    public function clubs_league()
    {
        return $this->belongsToMany(
            Club::class,
            'league_standings',
            'comp_id',
            'club_id'
        )->withPivot('position', 'goals_scored', 'goals_against', 'form', 'matches_played', 'wins', 'losses', 'draws', "points");
    }
}
