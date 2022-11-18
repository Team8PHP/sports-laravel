<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        'home_id',
        'away_id',
        'status',
        'comp_id',
        'stage',
        'date',
        'matchday',
        'home_score',
        'away_score',
        'time'
    ];
}
