<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('banner_img')->nullable();
            $table->text('section1_title')->nullable();
            $table->longText('section1_description')->nullable();
            $table->string('section1_img')->nullable();
            $table->text('section2_title1')->nullable();
            $table->longText('section2_description1')->nullable();
            $table->string('section2_img2')->nullable();
            $table->string('section3_title')->nullable();
            $table->string('section3_back_img')->nullable();
            $table->string('section3_title1')->nullable();
            $table->string('section3_description1')->nullable();
            $table->string('section3_image1')->nullable();
            $table->string('section3_title2')->nullable();
            $table->longText('section3_description2')->nullable();
            $table->string('section3_image2')->nullable();
            $table->string('section3_title3')->nullable();
            $table->string('section3_description3')->nullable();
            $table->string('section3_image3')->nullable();
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
        Schema::dropIfExists('about_us');
    }
}
