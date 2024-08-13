<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletMoneyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_money_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('transaction_id');
            $table->string('transaction_type')->nullable();
            $table->string('transaction_amount');
            $table->string('last_available_balance')->nullable();
            $table->string('transaction_description')->nullable();
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
        Schema::dropIfExists('wallet_money_transactions');
    }
}
