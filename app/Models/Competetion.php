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
        return $this->belongsToMany(Club::class, "comp_club", "comp_id", "club_id");
    }
}
