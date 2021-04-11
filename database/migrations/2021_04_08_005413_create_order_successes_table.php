<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSuccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_successes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('studio_id')->unsigned();
            $table->integer('amount')->default(0);
            $table->integer('service_fee')->default(0);
            $table->integer('paid')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('jasa_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_successes');
    }
}
