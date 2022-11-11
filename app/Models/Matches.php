<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_id',
        'away_id',
        'status',
        'comp_id',
        'stage',
        'date',
        'matchday',
        'home_score',
        'away_score'
    ];

    public function competetion(){
        return $this->belongsTo(Competetion::class);
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
