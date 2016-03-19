<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{

        public function up()
    {
      Schema::create('news', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
            $table->timestamps();
        });
    }
    public function down()
    {
      Schema::drop('news');
    }
}
