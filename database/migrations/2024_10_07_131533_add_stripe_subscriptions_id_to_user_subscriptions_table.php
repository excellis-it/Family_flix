<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripeSubscriptionsIdToUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
            $table->string('stripe_subscription_id')->nullable()->after('paypal_plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {

            $table->dropColumn(['stripe_subscription_id']);
        });
    }
}
