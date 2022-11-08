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
            'position'=>$this->position,
            'goals'=>$this->goals,
            'club'=>new ClubResource($this->club)
        ];
    }
}
