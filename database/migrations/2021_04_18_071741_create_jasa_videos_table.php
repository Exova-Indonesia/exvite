<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jasa_id')->unsigned()->nullable();
            $table->longText('path')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('jasa_videos');
    }
}
