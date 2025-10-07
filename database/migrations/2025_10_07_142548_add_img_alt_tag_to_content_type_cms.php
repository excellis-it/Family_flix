<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToContentTypeCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_type_cms', function (Blueprint $table) {
            $table->string('img_alt_tag')->nullable()->after('top_10_show_background');
            $table->string('img1_alt_tag')->nullable()->after('popular_show_background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_type_cms', function (Blueprint $table) {
            $table->dropColumn(['img_alt_tag', 'img1_alt_tag']);
        });
    }
}
