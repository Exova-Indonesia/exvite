<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transaction', function (Blueprint $table) {
            $table->id('wal_transaction_id');
            $table->string('wal_reference_id')->nullable();
            $table->string('wal_credited_wallet');
            $table->string('wal_debited_wallet');
            $table->string('wal_debited_bank')->nullable();
            $table->string('wal_description');
            $table->string('wal_amount');
            $table->string('wal_transaction_type');
            $table->string('wal_status');
            $table->string('wal_token');
            $table->string('wal_invoice');
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
        Schema::dropIfExists('wallet_transaction');
    }
}
