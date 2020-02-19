<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Movie extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'rating' => $this->rating,
            'release_date' => $this->release_date,
            'price' => $this->price,
            'country' => $this->country,
            'genre' => $this->genre,
            'image' => $this->image,
            'slug' => $this->slug,
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
