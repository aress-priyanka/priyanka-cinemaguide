<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cinemas', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('address');
      $table->decimal('latitude', 11, 7);
      $table->decimal('longitude', 11, 7);
      $table->unsignedSmallInteger('seating_capacity');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cinemas');
  }
}
