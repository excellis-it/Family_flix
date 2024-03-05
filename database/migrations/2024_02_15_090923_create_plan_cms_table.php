<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_cms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('banner_img')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('main_title')->nullable();
            $table->string('background_img')->nullable();
            $table->string('middle_back_img')->nullable();
            $table->longText('middle_content')->nullable();
            $table->string('anime1_img')->nullable();
            $table->string('anime2_img')->nullable();
            $table->string('title1')->nullable();
            $table->longText('description1')->nullable();
            $table->string('title2')->nullable();
            $table->longText('description2')->nullable();
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
        Schema::dropIfExists('plan_cms');
    }
}
