<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cinema;
use App\Http\Resources\CinemaResource;
use App\Http\Resources\CinemaCollection as CinemaCollection;

class CinemaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //List of cinemas
    return new CinemaCollection(Cinema::orderBy('created_at', 'desc')->simplePaginate(5));
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $name
   * @return \Illuminate\Http\Response
   */
  public function detail($name)
  {
    // Get cinema detail by name
    $cinema = Cinema::where('name', '=', $name)->first();
    if ($cinema !== null) {
      return new CinemaResource($cinema);
    }

    return response()->json(['error'=> 'No results found'], 404);
  }
}
