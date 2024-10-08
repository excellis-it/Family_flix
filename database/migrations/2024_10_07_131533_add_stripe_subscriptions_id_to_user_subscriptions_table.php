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
            $table->string('stripe_subscription_id')->nullable()->after('paypal_plan_id');
            $table->boolean('subscription_status')->default(1)->comment('1=active, 2=cancel, 3=expired, 4=renewal'); // 1=active, 2=cancel, 3=expired

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
            $table->dropColumn(['subscription_status']);
        });
    }
}
