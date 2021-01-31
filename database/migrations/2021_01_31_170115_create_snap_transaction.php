<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snap_transaction', function (Blueprint $table) {
            $table->id('snap_transaction_id');
            $table->string('snap_reference_id')->nullable();
            $table->string('snap_credited_wallet');
            $table->string('snap_debited_wallet');
            $table->string('snap_debited_bank')->nullable();
            $table->string('snap_description');
            $table->string('snap_amount');
            $table->string('snap_transaction_type');
            $table->string('snap_status');
            $table->string('snap_token');
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
        Schema::dropIfExists('snap_transaction');
    }
}
