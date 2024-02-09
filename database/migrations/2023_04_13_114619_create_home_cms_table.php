<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_cms', function (Blueprint $table) {
            $table->id();
            $table->string('top_back_image')->nullable();
            $table->string('top_short_title')->nullable();
            $table->string('top_main_title')->nullable();
            $table->string('top_button_text')->nullable();
            $table->string('section1_main_image')->nullable();
            $table->string('section1_back_image')->nullable();
            $table->string('section2_back_image')->nullable();
            $table->string('section2_main_image')->nullable();
            $table->string('section2_title')->nullable();
            $table->longText('section2_description')->nullable();
            $table->string('section2_short_title')->nullable();
            $table->string('section2_main_icon')->nullable();
            $table->string('section2_icon1')->nullable();
            $table->string('section2_icon2')->nullable();
            $table->string('section2_icon3')->nullable();
            $table->string('section2_icon4')->nullable();
            $table->string('section2_icon5')->nullable();
            $table->string('section2_icon6')->nullable();
            $table->string('section2_icon7')->nullable();
            $table->string('section2_icon8')->nullable();
            $table->string('section3_back_image')->nullable();
            $table->string('section3_main_image')->nullable();
            $table->string('section3_title')->nullable();
            $table->string('section3_video_link')->nullable();
            $table->string('section4_title')->nullable();
            $table->longText('section4_description')->nullable();
            $table->string('section4_back_image')->nullable();
            $table->string('section5_back_image')->nullable();
            $table->string('section5_main_title')->nullable();
            $table->longText('section5_main_description')->nullable();
            $table->string('section5_main_image')->nullable();
            $table->string('plan_section_title')->nullable();
            $table->string('plan_section_back_image')->nullable();
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
        Schema::dropIfExists('home_cms');
    }
}
