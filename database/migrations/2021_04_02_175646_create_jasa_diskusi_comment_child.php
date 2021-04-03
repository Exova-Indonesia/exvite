<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaDiskusiCommentChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('jasa_diskusi_comment_child', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('user_id')->unsigned();
        //     $table->bigInteger('parent_id')->unsigned();
        //     $table->text('content');

        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('parent_id')->references('id')->on('jasa_diskusi_comment')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_diskusi_comment_child');
    }
}
