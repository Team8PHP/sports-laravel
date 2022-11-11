<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image',
        'tla',
        'venue',
        'founded',
    ];

    // public function favourites()
    // {
    //     return $this->belongsToMany(Favourite::class);
    // }

    // public function players()
    // {
    //     return $this->belongsToMany(
    //         players::class,
    //         'scorers',
    //         'club_id',
    //         'player_id',
    //     );
    // }

    public function players()
    {
       return $this->hasMany(Player::class);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            "favourites",
            "club_id",
            "user_id"
        )->withPivot('id');
    }

    public function competetion()
    {
        return $this->belongsToMany(
            Competetion::class,
            "comp_clubs",
            "club_id",
            "comp_id"
        );
    }

    public function comp_groups()
    {
        return $this->belongsToMany(
            Competetion::class,
            'group_standings',
            'club_id',
            'comp_id'
        )->withPivot('position', 'group_name','goals_scored','goals_against','form','matches_played','wins','losses','draws');
    }

    public function comp_league()
    {
        return $this->belongsToMany(
            Competetion::class,
            'league_standings',
            'club_id',
            'comp_id'
        )->withPivot('position','goals_scored','goals_against','form','matches_played','wins','losses','draws');
    }

    
}
