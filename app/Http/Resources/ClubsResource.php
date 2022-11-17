<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubsResource extends JsonResource
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
            'club_id' => $this->Id,
            'club_image' => $this->image,
            'club_tla' => $this->tla,
            'club_venue' => $this->venue,
            'club_founded' => $this->founded,
            'country' => $this->country_name,
            'country_image' => $this->country_image,
            'competitions' =>  $this->competetion,
            'players' =>  $this->players
            // 'comp_id'=>$this->comp_id,
        ];
    }
}
