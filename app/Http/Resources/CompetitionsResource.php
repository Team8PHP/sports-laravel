<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionsResource extends JsonResource
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
            'comp_name'=>$this->name,
            'comp_image'=>$this->image,
            'comp_country'=>$this->country,
            'comp_country_image'=>$this->country_image,
        ];
    }
}
