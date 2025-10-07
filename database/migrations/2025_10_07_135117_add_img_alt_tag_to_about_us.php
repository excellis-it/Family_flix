<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgAltTagToAboutUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('section1_img_alt_tag')->nullable()->after('section1_img');
            $table->string('section2_img_alt_tag')->nullable()->after('section2_img2');
            $table->string('section3_back_img_alt_tag')->nullable()->after('section3_back_img');
            $table->string('section3_img1_alt_tag')->nullable()->after('section3_image1');
            $table->string('section3_img2_alt_tag')->nullable()->after('section3_image2');
            $table->string('section3_img3_alt_tag')->nullable()->after('section3_image3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['section1_img_alt_tag', 'section2_img_alt_tag', 'section3_back_img_alt_tag', 'section3_img1_alt_tag', 'section3_img2_alt_tag', 'section3_img3_alt_tag']);
        });
    }
}
