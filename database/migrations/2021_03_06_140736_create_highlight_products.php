<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlight_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('jasa_id')->on('jasa_products')->onDelete('cascade');
            $table->bigInteger('plan_id')->unsigned();
            // $table->foreign('plan_id')->references('id')->on('highlight_plan')->onDelete('cascade');
            $table->string('type');
            $table->dateTime('start_at');
            $table->dateTime('ends_at');
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
        Schema::dropIfExists('highlight_products');
    }
}
