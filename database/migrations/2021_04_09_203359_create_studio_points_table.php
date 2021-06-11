<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudioPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('studio_id')->unsigned();
            $table->bigInteger('order_id')->nullable();
            $table->integer('value');
            $table->string('source');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studio_points');
    }
}
