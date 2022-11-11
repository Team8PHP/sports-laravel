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

    public function players()
    {
        return $this->belongsToMany(
            players::class,
            'scorers',
            'club_id',
            'player_id',
        );
    }

        public function users()
        {
            return $this->belongsToMany(User::class, "favourites", "club_id", "user_id");
        }

        public function competetion()
        {
            return $this->belongsToMany(Competetion::class, "comp_club", "club_id", "comp_id");
        }
}
