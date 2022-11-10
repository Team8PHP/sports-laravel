<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    public function competetion(){
        return $this->belongsTo('competetions');
    }
    public function matches_homecomp()
    {
        return $this->belongsToMany(
            Club::class,
            'matches',
            'home_id',
            'comp_id',
        );
    }
    public function matches_awaycomp()
    {
        return $this->belongsToMany(
            Club::class,
            'matches',
            'away_id',
            'comp_id',
        );
    }
}
