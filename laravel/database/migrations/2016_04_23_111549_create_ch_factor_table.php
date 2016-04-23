<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChFactorTable extends Migration
{

        public function up()
    {
      Schema::create('ch_factor', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
            $table->timestamps();
        });
    }
    public function down()
    {
      Schema::drop('ch_factor');
    }
}
