<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\MovieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});


// Public Routes
Route::post("/register",[App\Http\Controllers\API\UserController::class, 'register']);
Route::post("/login",[App\Http\Controllers\API\UserController::class, 'login']);
Route::post("/logout",[App\Http\Controllers\API\UserController::class, 'logout']);

Route::group(['middleware' => 'auth:api'], function () {
  Route::get('/cinemas', [App\Http\Controllers\Api\CinemaController::class, 'index'])->name('cinemas');
  Route::get('/cinemas/{name}', [App\Http\Controllers\Api\CinemaController::class, 'detail'])->name('cinema-detail');
  Route::get('/movies', [App\Http\Controllers\Api\MovieController::class, 'index'])->name('movies');
  Route::get('/movies/{name}', [App\Http\Controllers\Api\MovieController::class, 'detail'])->name('movie-detail');
  Route::get('/movies/{name}/{date}', [App\Http\Controllers\Api\MovieController::class, 'movie_session'])->name('movie-session');
});