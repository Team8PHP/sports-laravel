<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayersResource extends JsonResource
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
            'name' => $this->name,
            'club_id'=>$this->club_id,
            'nationality' => $this->nationality,
            'goals' => $this->pivot->goals,
            'comp_id' => $this->pivot->comp_id,
            // 'club' => $this->club->where('comp_id', $this->pivot->comp_id)->all()
            'club' => $this->club
            // 'club' => ClubsResource::collection)
        ];
    }
}
