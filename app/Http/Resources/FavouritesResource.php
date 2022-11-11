<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouritesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'favourite_id' => $this->pivot->id,
            'club_name' => $this->name,
            'club_image' => $this->image
            // 'club_image' => $this->clubs->image
            // 'club' => ClubsResource::collection($this->clubs)
        ];
    }
}
