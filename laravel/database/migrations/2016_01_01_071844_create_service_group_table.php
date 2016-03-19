<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceGroupTable extends Migration
{

        public function up()
    {
      Schema::create('service_group', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
            $table->timestamps();
        });
    }
    public function down()
    {
      Schema::drop('service_group');
    }
}
