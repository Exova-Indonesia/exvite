<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaOrdersMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_orders_media', function (Blueprint $table) {
            $table->id('jasa_order_media_id');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('jasa_orders')->onDelete('cascade');
            $table->text('example');
            $table->text('example_ori');
            $table->text('result');
            $table->text('revision');
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
        Schema::dropIfExists('jasa_orders_media');
    }
}
