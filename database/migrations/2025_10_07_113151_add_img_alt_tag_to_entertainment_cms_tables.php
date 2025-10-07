<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToEntertainmentCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entertainment_cms', function (Blueprint $table) {
            $table->string('image_alt_tag')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entertainment_cms', function (Blueprint $table) {
            $table->dropColumn('image_alt_tag');
        });
    }
}
