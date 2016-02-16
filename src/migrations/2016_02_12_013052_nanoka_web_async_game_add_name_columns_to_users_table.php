<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NanokaWebAsyncGameAddNameColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('async_game_users', function (Blueprint $table) {
            $table->index('device_id', 'facebook_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('async_game_users', function (Blueprint $table) {
            $table->dropIndex('device_id', 'facebook_user_id');
        });
    }
}
