<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->char('phone', 13)->nullable();
            $table->bigInteger('sex')->nullable()->unsigned();
            $table->bigInteger('avatar')->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->bigInteger('subscription')->defaut(0)->unsigned();
            $table->string('birthday')->nullable();
            $table->timestamps();
            $table->string('suspended', 12)->nullable();


            // $table->foreign('sex')->references('sex_id')->on('user_sex')->onDelete('cascade');
            // $table->foreign('subscription')->references('subscription_id')->on('user_subscription')->onDelete('cascade');
            // $table->foreign('avatar')->references('avatar_id')->on('user_avatar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
