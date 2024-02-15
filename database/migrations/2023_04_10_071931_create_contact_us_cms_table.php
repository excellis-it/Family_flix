<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_cms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('background_img')->nullable();
            $table->string('main_title')->nullable();
            $table->longText('short_title')->nullable();
            $table->string('button_name')->nullable();
            $table->string('map_link')->nullable();
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
        Schema::dropIfExists('contact_us_cms');
    }
}
