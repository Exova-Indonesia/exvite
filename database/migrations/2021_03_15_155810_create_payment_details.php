<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id('payment_id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('payment_method');
            $table->string('path');
            $table->integer('amount');
            $table->integer('discount');
            $table->integer('admin_fee');
            $table->integer('total');
            $table->string('status');
            $table->string('invoice');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
