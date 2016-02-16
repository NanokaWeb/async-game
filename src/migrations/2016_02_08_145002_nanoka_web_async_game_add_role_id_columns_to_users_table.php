<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NanokaWebAsyncGameAddRoleIdColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('async_game_users', function(Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('async_game_roles');
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
            $table->dropForeign('async_game_users_role_id_foreign');
            $table->dropColumn(
                'role_id'
            );
        });
    }
}
