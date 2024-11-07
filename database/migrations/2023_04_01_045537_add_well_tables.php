<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWellTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishingwell', function (Blueprint $table) {
            $table->id();
            $table->INTEGER('user_id');
            $table->INTEGER('amount')->nullable();
            $table->DATETIME('last_wish')->nullable();
            $table->TEXT('reward')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishingwell');
    }
}
