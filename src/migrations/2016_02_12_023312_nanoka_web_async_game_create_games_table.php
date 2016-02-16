<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NanokaWebAsyncGameCreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('async_game_games', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('data');
            $table->integer('score');
            $table->timestamps();
            $table->unsignedInteger('seed_id');
            $table->unsignedInteger('user_id');
            $table->foreign('seed_id')->references('id')->on('async_game_seeds');
            $table->foreign('user_id')->references('id')->on('async_game_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('async_game_games');
    }
}
