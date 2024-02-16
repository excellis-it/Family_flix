<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kids_cms', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('small_description')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('top_10_show_background')->nullable();
            $table->string('popular_kids_background')->nullable();
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
        Schema::dropIfExists('kids_cms');
    }
}
