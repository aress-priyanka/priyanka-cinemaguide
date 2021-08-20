<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'address',
    'latitude',
    'longitude',
    'seating_capacity'
  ];

  public function cinema_movies() {
    return $this->hasMany(App\CinemaMovie::class);
  }
}
