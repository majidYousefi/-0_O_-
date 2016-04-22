<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtisanTable extends Migration
{

        public function up()
    {
      Schema::create('artisan', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
            $table->timestamps();
        });
    }
    public function down()
    {
      Schema::drop('artisan');
    }
}
