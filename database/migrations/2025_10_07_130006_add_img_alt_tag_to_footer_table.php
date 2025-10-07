<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('footer_cms', function (Blueprint $table) {
            $table->string('footer_logo_img_alt_tag')->nullable()->after('footer_logo');
            $table->string('footer_image_img_alt_tag')->nullable()->after('footer_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('footer_cms', function (Blueprint $table) {
            $table->dropColumn(['footer_logo_img_alt_tag', 'footer_image_img_alt_tag']);
        });
    }
}
