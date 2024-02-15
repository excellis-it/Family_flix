<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_cms', function (Blueprint $table) {
            $table->id();
            $table->string('section1_title')->nullable();
            $table->longText('section1_description')->nullable();
            $table->string('section1_background_img')->nullable();
            $table->string('section1_button_name')->nullable();
            $table->string('subscribe_title')->nullable();
            $table->string('subscription_placeholder')->nullable();
            $table->string('button_name')->nullable();
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
        Schema::dropIfExists('subscribe_cms');
    }
}
