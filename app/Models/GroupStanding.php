<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'comp_id',
        'club_id',
        'position',
        'goals',
        'group_name',
    ];

    public function clubs(){
        return $this->hasMany('clubs');
    }
}
