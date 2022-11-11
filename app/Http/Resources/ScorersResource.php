<?php

namespace App\Http\Resources;

use App\Models\Player;
use Illuminate\Http\Resources\Json\JsonResource;

class ScorersResource extends JsonResource
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
            'player_id'=>$this->player_id,
            // 'player'=>Player::find($this->player_id)  
        ];
    }
}
