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
        'goals',
    ];

    // public function club()
    // {
    //     return $this->hasMany(Club::class);
    // }
}
