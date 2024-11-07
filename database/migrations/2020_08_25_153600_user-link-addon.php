<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserLinkAddon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add columns
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('insta', 40)->nullable($value = true);
            $table->string('house', 60)->nullable($value = true);
            $table->string('disc', 40)->nullable($value = true);
            $table->string('devian', 50)->nullable($value = true);
            $table->string('tumb', 50)->nullable($value = true);
            $table->string('twitt', 50)->nullable($value = true);
            $table->string('youtu', 60)->nullable($value = true);
            $table->string('newgr', 60)->nullable($value = true);
            $table->string('artsta', 50)->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            //
            $table->dropColumn('insta');
            $table->dropColumn('house');
            $table->dropColumn('disc');
            $table->dropColumn('devian');
            $table->dropColumn('tumb');
            $table->dropColumn('twitt');
            $table->dropColumn('youtu');
            $table->dropColumn('newgr');
            $table->dropColumn('artsta');
        });
    }
}
