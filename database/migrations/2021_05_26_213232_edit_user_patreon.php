<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserPatreon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_patreons', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->dropForeign(['user_id']);
            //$table->integer('user_id')->unsigned(false)->change();
        });

        Schema::table('user_patreons', function (Blueprint $table) {
            $table->integer('user_id')->unsigned(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_patreons', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned()->change();
        });
    }
}
