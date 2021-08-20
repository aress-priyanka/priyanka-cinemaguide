<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use File;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get paginated list of movies
    $movies = Movie::orderBy('created_at', 'desc')->paginate(10);
    return view('movie.list', compact('movies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $parental_rating_types = config('cinemaguide.parental_rating_types');
    return view('movie.add-edit', compact('parental_rating_types'));
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
      'title' => 'required',
      'parental_rating' => 'required',
      'movie_length' => 'required',
      'poster' => 'required|mimes:png,jpg|max:5120|dimensions:min_width=100,min_height=100'
    ]);

    $path = public_path(config('cinemaguide.poster_upload_path'));
    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

    $fileName = $this->getFileName().'.'.$request->file('poster')->extension();
    $request->file('poster')->move(public_path('posters'), $fileName);

    $data = $request->all();
    $data['poster'] = $fileName;
    Movie::create($data);

    return redirect()->route('movies.index')
            ->with('success','Movie created successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function edit(Movie $movie)
  {
    $parental_rating_types = config('cinemaguide.parental_rating_types');

    // Load movie edit view
    return view('movie.add-edit', compact('parental_rating_types', 'movie'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Movie $movie)
  {
    // Add validations to the fields
    $request->validate([
      'title' => 'required',
      'parental_rating' => 'required',
      'movie_length' => 'required',
      'poster' => 'required|mimes:png,jpg|max:5120|dimensions:min_width=100,min_height=100'
    ]);

    $data = $request->all();
    if( $request->file('poster') ) {
      $path = public_path(config('cinemaguide.poster_upload_path'));
      File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

      $fileName = $this->getFileName().'.'.$request->file('poster')->extension();
      $request->file('poster')->move(public_path('posters'), $fileName);

      $data['poster'] = $fileName;

      // Delete poster image when adding new movie poster
      $movieData = Movie::where('id', '=', $movie->id)->first();
      $path = public_path(config('cinemaguide.poster_upload_path').$movieData->poster);

      if (File::exists($path)) {
        unlink($path);
      }
    }

    $movie->update($data);

    return redirect()->route('movies.index')
            ->with('success','Movie updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie)
  {
    // Delete poster image when deleting movie
    $movieData = Movie::where('id', '=', $movie->id)->first();
    $path = public_path(config('cinemaguide.poster_upload_path').$movieData->poster);

    if (File::exists($path)) {
      unlink($path);
    }
    $movie->delete();

    return redirect()->route('movies.index')
            ->with('success','Movie deleted successfully!');
  }

  public function getFileName() {
    mt_srand();
    return md5(uniqid(mt_rand()));
  }
}
