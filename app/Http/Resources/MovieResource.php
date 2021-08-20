<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
      'id' => $this->id,
      'title' => $this->title,
      'parental_rating' => $this->parental_rating,
      'movie_length' => $this->movie_length,
      'poster' => $this->poster,
      'movie_time'=> $this->movie_time
    ];
  }
}
