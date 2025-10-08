<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToImgAltTagToSubscribeCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_cms', function (Blueprint $table) {
            $table->string('section1_background_img_alt_tag')->nullable()->after('section1_background_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_cms', function (Blueprint $table) {
            $table->dropColumn('section1_background_img_alt_tag');
        });
    }
}
