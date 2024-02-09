<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_cms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('section_title')->nullable();
            $table->longText('section_description')->nullable();
            $table->text('visit_us')->nullable();
            $table->string('call_us')->nullable();
            $table->string('mail_us')->nullable();
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
        Schema::dropIfExists('contact_us_cms');
    }
}
