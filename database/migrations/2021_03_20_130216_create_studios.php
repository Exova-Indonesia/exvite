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
            $table->boolean('is_official')->default(false);
            $table->boolean('suspend')->default(false);
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
        Schema::dropIfExists('studios');
    }
}
