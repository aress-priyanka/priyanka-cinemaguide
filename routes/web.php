<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaMovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [CinemaController::class, 'index'])->name('cinema');
    Route::resource('cinemas', CinemaController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('cinema-movie', CinemaMovieController::class);
    Route::get('cinema-movie/create/{cinema_id}', [CinemaMovieController::class, 'create'])->name('cinema-movie.create');
    Route::get('cinema-movie/{cinema_movie_id}/edit', [CinemaMovieController::class, 'edit'])->name('cinema-movie.edit');
});
