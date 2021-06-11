<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_products', function (Blueprint $table) {
            $table->id('jasa_id');
            $table->bigInteger('studio_id')->unsigned();
            $table->string('jasa_name');
            $table->string('slugs');
            $table->integer('jasa_subcategory')->nullable();
            $table->string('jasa_deskripsi')->nullable();
            $table->integer('jasa_price')->nullable();
            $table->integer('jasa_price_old')->nullable();
            $table->integer('jasa_revision')->default(0);
            $table->text('jasa_thumbnail')->nullable();
            // $table->integer('jasa_rating')->default(0);
            $table->integer('jasa_sold')->default(0);
            $table->integer('jasa_cancel')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('jasa_products');
    }
}
