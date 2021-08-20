<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
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
