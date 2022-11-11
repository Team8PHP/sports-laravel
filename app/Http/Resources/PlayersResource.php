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
            'nationality' => $this->nationality,
            'goals' => $this->pivot->goals,
            'club' => $this->club,
            // 'club'=>new ClubsResource($this->club)
        ];
    }
}
