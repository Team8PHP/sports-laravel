<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'news_id'=>$this->id,
            'author'=>$this->author,
            'source'=>$this->source,
            'news_image'=>$this->urlToImage,
            'news_link'=>$this->url,
            'title'=>$this->title,
            'description'=>$this->description,
            'content'=>$this->content,
            'date'=>$this->date,
            'time'=>$this->time
        ];
    }
}
