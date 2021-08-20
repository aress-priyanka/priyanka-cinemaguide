<?php

namespace App\Http\Controllers;

use App\Models\CinemaMovie;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaMovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($cinema_id)
  {
    // Get all movies
    $movies = Movie::all();

    // Get cinema details linked to session
    $cinema = Cinema::where('id', '=', $cinema_id)->first();

    return view('cinema_movie.add-edit',compact('movies', 'cinema_id', 'cinema'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Add validations to the fields
    $request->validate([
      'cinema_id' => 'required',
      'movie_id' => 'required',
      'movie_time' => 'required'
    ]);

    CinemaMovie::create($request->all());

    return redirect()->route('cinemas.show', $request->cinema_id)
            ->with('success','Movie added to cinema successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CinemaMovie  $cinemaMovie
   * @return \Illuminate\Http\Response
   */
  public function show(CinemaMovie $cinemaMovie)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CinemaMovie  $cinemaMovie
   * @return \Illuminate\Http\Response
   */
  public function edit(CinemaMovie $cinemaMovie)
  {
    // Get all movies
    $movies = Movie::all();

    // Get cinema details linked to session
    $cinema = Cinema::where('id', '=', $cinemaMovie->cinema_id)->first();

    // Load cinema edit view
    return view('cinema_movie.add-edit',compact('movies', 'cinemaMovie', 'cinema'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\CinemaMovie  $cinemaMovie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, CinemaMovie $cinemaMovie)
  {
    // Add validations to the fields
    $request->validate([
      'cinema_id' => 'required',
      'movie_id' => 'required',
      'movie_time' => 'required'
    ]);

    $cinemaMovie->update($request->all());

    return redirect()->route('cinemas.show', $request->cinema_id)
            ->with('success','Movie updated to cinema successfully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CinemaMovie  $cinemaMovie
   * @return \Illuminate\Http\Response
   */
  public function destroy(CinemaMovie $cinemaMovie)
  {
    // Get cinema id for redirection before delete
    $cinemaMovieData = CinemaMovie::where('id', '=', $cinemaMovie->id)->first();
    $cinemaMovie->delete();

    return redirect()->route('cinemas.show', $cinemaMovieData->cinema_id)
            ->with('success','Movie has been deleted successfully from cinema!');
  }
}
