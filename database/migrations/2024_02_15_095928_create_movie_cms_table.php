<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_cms', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('small_description')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('top10_show_back_img')->nullable();
            $table->string('popular_movie_background')->nullable();
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
        Schema::dropIfExists('movie_cms');
    }
}
