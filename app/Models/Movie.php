<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'parental_rating',
    'movie_length',
    'poster'
  ];

  public function cinema_movies() {
    return $this->hasMany(App\CinemaMovie::class);
  }
}
