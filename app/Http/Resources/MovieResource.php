<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'year_of_issue' => $this->year_of_issue,
            'description' => $this->description,
            'genres' => GenreResource::collection($this->genres),
            'actors' => ActorResource::collection($this->actors)
        ];
    }
}
