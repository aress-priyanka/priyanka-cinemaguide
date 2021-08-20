<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('movies', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->enum('parental_rating', ['G', 'PG', 'M', 'MA 15+', 'R 18+', 'X 18+']);
      $table->unsignedSmallInteger('movie_length');
      $table->string('poster');
      $table->timestamps();
      $table->unique('title', 'unq_title');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('movies');
  }
}
