<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieCollection as MovieCollection;

class MovieController extends Controller
{
  /**
   * Display list of movies
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //List of movies
    return new MovieCollection(Movie::orderBy('created_at', 'desc')->simplePaginate(5));
  }

  /**
   * Return movie detail.
   *
   * @param  string  $name
   * @return \Illuminate\Http\Response
   */
  public function detail($name)
  {
    // Get movie detail by name
    $movie = Movie::where('title', '=', $name)->first();
    if ($movie !== null) {
      return new MovieResource($movie);
    }

    return response()->json(['error'=> 'No results found'], 404);
  }

  /**
   * Get list of movies playing at a given cinema on a given date
   *
   * @param  string  $cinema, $date
   * @return \Illuminate\Http\Response
   */
  public function movie_session($cinema, $date)
  {
    // Get List of movies associated with Cinema
    $movies = Movie::join('cinema_movie', 'cinema_movie.movie_id', '=', 'movies.id')
                  ->join('cinemas', 'cinema_movie.cinema_id', '=', 'cinemas.id')
                  ->where('cinemas.name', 'like', '%' . $cinema . '%')
                  ->whereDate('cinema_movie.movie_time', '=', date("Y-m-d", strtotime($date)))
              		->get(['movies.id', 'movies.title', 'movies.parental_rating', 'movies.movie_length', 'movies.poster', 'cinema_movie.movie_time']);

    if ($movies !== null) {
      return new MovieCollection($movies);
    }

    return response()->json(['error'=> 'No results found'], 404);
  }
}
