<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nationality',
        'club_id',
        'birth_date',
    ];

    // public function club()
    // {
    //     return $this->belongsToMany(Club::class);
    // }

    public function competition()
    {
        return $this->belongsToMany(
            Competetion::class,
            'scorers',
            'player_id',
            'comp_id'
        )->withPivot('goals');
    }


    public function club()
    {
        return $this->belongsToMany(
            Club::class,
            'scorers',
            'player_id',
            'club_id'

        );
    }
}
