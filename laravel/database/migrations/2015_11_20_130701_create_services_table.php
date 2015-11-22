<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
      Schema::create('services', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);
             $table->integer('serv_id');  
            $table->integer('creator_id');          
            $table->string('parent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('services');
    }
}