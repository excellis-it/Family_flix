<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToEntertainmentBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entertainment_banners', function (Blueprint $table) {
            $table->string('img_alt_tag')->nullable()->after('banner_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entertainment_banners', function (Blueprint $table) {
            $table->dropColumn('img_alt_tag');
        });
    }
}
