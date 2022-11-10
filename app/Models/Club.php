<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    // public function leagueStandings()
    // {
    //     return $this->belongsTo(LeagueStanding::class);
    // }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'favourites',
            'club_id',
            'user_id'
        );
    }


    public function competitions()
    {
        return $this->belongsToMany(
            Competetion::class,
            'club_competition',
            'club_id',
            'comp_id'
        );
    }

        public function comp_league()
        {
            return $this->belongsToMany(
                Competetion::class,
                'league_standings',
                'club_id',
                'comp_id'
            )->withPivot('goals');
        }

        public function comp_groups()
        {
            return $this->belongsToMany(
                Competetion::class,
                'group_standings',
                'club_id',
                'comp_id'
            );
        }

        public function group_standing(){
            return $this->belongsTo('group_standings');
        }
}
