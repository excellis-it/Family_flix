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
            $table->bigInteger('customer_details_id')->nullable();
            $table->string('affiliate_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('plan_price')->nullable();
            $table->string('coupan_code')->nullable();
            $table->string('coupan_discount')->nullable();
            $table->string('coupan_discount_type')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->string('affiliate_commission')->nullable();
            $table->longText('additional_information')->nullable();
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
