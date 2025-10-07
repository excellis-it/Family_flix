<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToHomeCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_cms', function (Blueprint $table) {
            $table->string('section1_main_img_alt_tag')->nullable()->after('section1_main_image');
            $table->string('section1_back_img_alt_tag')->nullable()->after('section1_back_image');
            $table->string('section2_main_img_alt_tag')->nullable()->after('section2_main_image');
            $table->string('section2_back_img_alt_tag')->nullable()->after('section2_back_image');
            $table->string('section3_main_img_alt_tag')->nullable()->after('section3_main_image');
            $table->string('section3_back_img_alt_tag')->nullable()->after('section3_back_image');
            $table->string('section4_back_img_alt_tag')->nullable()->after('section4_back_image');
            $table->string('section5_back_img_alt_tag')->nullable()->after('section5_back_image');
            $table->string('section5_main_img_alt_tag')->nullable()->after('section5_main_image');
            $table->string('plan_section_back_img_alt_tag')->nullable()->after('plan_section_back_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_cms', function (Blueprint $table) {
            $table->dropColumn(['section1_main_img_alt_tag', 'section1_back_img_alt_tag', 'section2_main_img_alt_tag', 'section2_back_img_alt_tag', 'section3_main_img_alt_tag', 'section3_back_img_alt_tag', 'section4_back_img_alt_tag', 'section5_back_img_alt_tag', 'section5_main_img_alt_tag']);
        });
    }
}
