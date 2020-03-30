<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecutionTimeToTodos extends Migration
{
    public function up()
    {
        Schema::table('todos', function (Blueprint $table){
            $table->dateTime('execution_time');
        });
    }

    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn(['execution_time']);
        });
    }
}
