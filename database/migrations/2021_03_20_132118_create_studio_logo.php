<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudioLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studio_logo', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->default('EX');
            $table->string('folder');
            $table->longText('small');
            $table->longText('medium');
            $table->longText('large');
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
        Schema::dropIfExists('studio_logo');
    }
}
