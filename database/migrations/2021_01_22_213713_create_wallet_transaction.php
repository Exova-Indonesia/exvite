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
            $table->bigInteger('wal_credited_wallet')->unsigned();
            $table->bigInteger('wal_debited_wallet')->unsigned();
            $table->string('wal_debited_bank')->nullable();
            $table->string('wal_description');
            $table->string('wal_amount');
            $table->string('wal_transaction_type');
            $table->string('wal_status');
            $table->string('wal_token');
            $table->string('wal_invoice');
            $table->timestamps();

            $table->foreign('wal_credited_wallet')->references('wallet_id')->on('wallets')->onDelete('cascade');
            $table->foreign('wal_debited_wallet')->references('wallet_id')->on('wallets')->onDelete('cascade');
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
