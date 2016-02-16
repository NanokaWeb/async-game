<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NanokaWebAsyncGameAddDeviceIdColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('async_game_users', function (Blueprint $table) {
            $table->string('device_id');
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
            $table->dropColumn(
                'device_id'
            );
        });
    }
}
