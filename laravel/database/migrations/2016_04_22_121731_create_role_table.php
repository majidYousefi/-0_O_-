<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{

        public function up()
    {
      Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
        });
    }
    public function down()
    {
      Schema::drop('role');
    }
}
