<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_additionals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('orders_detail_id')->unsigned();
            $table->bigInteger('additional_id')->unsigned();
            $table->string('title')->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('add_day')->nullable();
            $table->timestamps();

            $table->foreign('orders_detail_id')->references('orders_detail_id')->on('orders_details')->onDelete('cascade');
            $table->foreign('additional_id')->references('id')->on('jasa_additional')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_additionals');
    }
}
