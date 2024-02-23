<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_subscription_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_currency')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
