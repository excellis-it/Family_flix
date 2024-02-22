<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customer_details')->onDelete('cascade')->nullable();
            $table->foreignId('plan_id')->references('id')->on('plans')->onDelete('cascade')->nullable();
            $table->string('sub_total')->nullable();
            $table->foreignId('coupon_id')->references('id')->on('coupons')->onDelete('cascade')->nullable();
            $table->string('total')->nullable();
            $table->string('payment_type')->nullable();
            $table->longText('additional_information')->nullable();
            $table->string('affiliate_id')->nullable();
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
        Schema::dropIfExists('user_subscriptions');
    }
}
