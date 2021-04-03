<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_additional', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('additional_id')->unsigned();
            $table->integer('quantity')->default(1);

            $table->foreign('cart_id')->references('cart_id')->on('cart_products')->onDelete('cascade');
            $table->foreign('additional_id')->references('id')->on('jasa_additional')->onDelete('cascade');
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
        Schema::dropIfExists('cart_additional');
    }
}
