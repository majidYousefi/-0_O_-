<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupTable extends Migration
{

        public function up()
    {
      Schema::create('user_group', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("title",250);          
            $table->string('services_id',250);
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
      Schema::drop('user_group');
    }
}
