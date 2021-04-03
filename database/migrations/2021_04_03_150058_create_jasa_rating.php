<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jasa_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('rating');
            $table->string('content');

            $table->foreign('jasa_id')->references('jasa_id')->on('jasa_products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('jasa_rating');
    }
}
