<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'nationality',
        'club_id',
        'position',
        'birth_date',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
