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
        Schema::table('users', function(Blueprint $table){
            $table->integer('accesslevel')->default(2);
            $table->string('bio')->nullable();
            $table->string('profpicture')->nullable();
            $table->string('socmedfb')->nullable();
            $table->string('socmedtwitter')->nullable();
            $table->string('socmedother')->nullable();
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
