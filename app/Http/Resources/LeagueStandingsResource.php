<?php

namespace App\Http\Resources;

use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class LeagueStandingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'club_name'=>$this->name,
            'club_image'=>$this->image,
            'position'=>$this->pivot->position,
            'goals'=>$this->pivot->goals
        ];
    }
}
