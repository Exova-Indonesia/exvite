<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->default('EX');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 20);
            $table->longText('description')->nullable();
            $table->string('slogan')->nullable();
            $table->string('subdomain')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->bigInteger('logo_id');
            $table->boolean('is_complete')->default(false);
            $table->boolean('suspend')->default(false);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('logo_id')->references('id')->on('studio_logo')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
    }
}
