<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_wallet_id')->constrained();
            $table->decimal('amount', 20, 4);
            $table->decimal('balance', 20, 4)->nullable();
            $table->decimal('prev_balance', 20, 4)->nullable();
            $table->string('comment');
            $table->string('type');
            $table->string('transaction_type');
            $table->string('transaction_id');
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
        Schema::dropIfExists('user_wallet_transactions');
    }
}
