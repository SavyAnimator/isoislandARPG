<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatreonTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('patreon_rewards', function (Blueprint $table) {
            $table->integer('month')->unsigned()->default(1);
            $table->string('rewardable_type');
            $table->integer('rewardable_id')->unsigned();
            $table->integer('quantity')->unsigned();

            // if you want to tier lock
            $table->integer('tier')->unsigned()->default(0);
            //$table->foreign('prompt_id')->references('id')->on('prompts');
        });

        Schema::create('user_patreons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('pledge_start')->nullable();
            // so if it's null, we dont give them rewards
            $table->timestamp('last_charge_date')->nullable();
            $table->string('last_charge_status')->nullable();
            // if theyre currently active
            $table->string('patron_status')->nullable();
            $table->string('avatar_url', 500)->nullable();
            // type of membership
            $table->integer('membership')->nullable();

            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();

            // validation area
            $table->timestamp('last_refresh')->nullable()->default(null);
            $table->boolean('allow_login')->default(0);
            $table->boolean('has_claimed')->default(0);

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropifExists('user_patreons');
        Schema::dropifExists('patreon_rewards');
    }
}
