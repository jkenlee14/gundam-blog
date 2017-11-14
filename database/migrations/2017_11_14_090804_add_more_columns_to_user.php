<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreColumnsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->integer('accesslevel');
            $table->string('bio');
            $table->string('profpicture');
            $table->string('socmedfb');
            $table->string('socmedtwitter');
            $table->string('socmedother');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('accesslevel');
            $table->dropColumn('bio');
            $table->dropColumn('profpicture');
            $table->dropColumn('socmedfb');
            $table->dropColumn('socmedtwitter');
            $table->dropColumn('socmedother');
        });
    }
}
