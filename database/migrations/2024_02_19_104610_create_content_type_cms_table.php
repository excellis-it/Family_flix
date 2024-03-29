<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTypeCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_img')->nullable();
            $table->string('heading')->nullable();
            $table->longText('small_description')->nullable();
            $table->string('top_10_show_background')->nullable();
            $table->string('popular_show_background')->nullable();
            $table->enum('type', ['kid', 'show','movie'])->nullable();
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
        Schema::dropIfExists('content_type_cms');
    }
}
