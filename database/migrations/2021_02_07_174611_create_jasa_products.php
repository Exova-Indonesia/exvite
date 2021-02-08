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
            $table->bigInteger('user_id');
            $table->string('jasa_name');
            $table->integer('jasa_subcategory');
            $table->string('jasa_deskripsi');
            $table->decimal('jasa_price');
            $table->decimal('jasa_price_old')->nullable();
            $table->integer('jasa_revision')->default(0);
            $table->text('jasa_thumbnail');
            $table->text('jasa_status');
            $table->integer('jasa_rating')->default(0);
            $table->integer('jasa_sold')->default(0);
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
