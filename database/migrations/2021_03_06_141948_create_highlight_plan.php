<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlight_plan', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('name');
            $table->json('benefits');
            $table->decimal('price');
            $table->decimal('price_old');
            $table->integer('ends_in_days');
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
        Schema::dropIfExists('highlight_plan');
    }
}
