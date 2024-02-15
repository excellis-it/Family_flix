<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntertainmentBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainment_banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image')->nullable();
            $table->string('banner_logo')->nullable();
            $table->string('rating')->nullable();
            $table->string('small_text')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('button_name')->nullable();
            $table->enum('banner_type', ['Shows','Kids','Movies'])->nullable();
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
        Schema::dropIfExists('entertainment_banners');
    }
}
