<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\CinemaMovie;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get paginated list of cinemas
    $cinemas = Cinema::orderBy('created_at', 'desc')->paginate(10);
    return view('cinema.list', compact('cinemas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('cinema.add-edit');
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
      'name' => 'required',
      'address' => 'required',
      'latitude' => 'required',
      'longitude' => 'required',
      'seating_capacity' => 'required'
    ]);

    Cinema::create($request->all());

    return redirect()->route('cinemas.index')
            ->with('success','Cinema created successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Cinema  $cinema
   * @return \Illuminate\Http\Response
   */
  public function show(Cinema $cinema)
  {
    // Get List of movies associated with Cinema
    $movies = Movie::join('cinema_movie', 'cinema_movie.movie_id', '=', 'movies.id')
                  ->where("cinema_movie.cinema_id", $cinema->id)
              		->get(['movies.title', 'movies.parental_rating', 'movies.movie_length', 'movies.poster', 'cinema_movie.id', 'cinema_movie.movie_time']);

    return view('cinema.view',compact('movies', 'cinema'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Cinema  $cinema
   * @return \Illuminate\Http\Response
   */
  public function edit(Cinema $cinema)
  {
    // Load cinema edit view
    return view('cinema.add-edit',compact('cinema'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Cinema  $cinema
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Cinema $cinema)
  {
    // Add validations to the fields
    $request->validate([
      'name' => 'required',
      'address' => 'required',
      'latitude' => 'required',
      'longitude' => 'required',
      'seating_capacity' => 'required'
    ]);

    $cinema->update($request->all());

    return redirect()->route('cinemas.index')
            ->with('success','Cinema updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Cinema  $cinema
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cinema $cinema)
  {
    //
    $cinema->delete();

    return redirect()->route('cinemas.index')
            ->with('success','Cinema deleted successfully!');
  }
}
