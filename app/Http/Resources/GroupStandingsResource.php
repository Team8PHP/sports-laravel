<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupStandingsResource extends JsonResource
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

            'club_name' => $this->name,
            'club_image' => $this->image,
            'position' => $this->pivot->position,
            'group' => $this->pivot->group_name,
            'goals_for' => $this->pivot->goals_scored,
            'goals_against' => $this->pivot->goals_against,
            'form' => explode(',', $this->pivot->form),
            'matches_played' => $this->pivot->matches_played,
            'wins' => $this->pivot->wins,
            'losses' => $this->pivot->losses,
            'draws' => $this->pivot->draws,
        ];
    }
}
