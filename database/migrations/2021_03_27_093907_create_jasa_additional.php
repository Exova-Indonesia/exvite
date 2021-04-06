<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_additional', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jasa_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(0);
            $table->string('add_day')->nullable();
            $table->timestamps();

            $table->foreign('jasa_id')->references('jasa_id')->on('jasa_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_additional');
    }
}
