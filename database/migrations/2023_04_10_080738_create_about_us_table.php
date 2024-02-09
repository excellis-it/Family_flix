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

            $table->string('section_1_name')->nullable();
            $table->text('section_1_title')->nullable();
            $table->longText('section_1_description')->nullable();
            $table->string('section_1_img')->nullable();
           
            $table->string('section_2_title')->nullable();
            $table->text('section_2_name')->nullable();
            $table->longText('section_2_description')->nullable();
            $table->string('section_2_img')->nullable();

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
