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
                  DB::table('user_group')->insert(
                        array(
                                array(
                                        'title' => 'توسعه دهنده',
                                        'services_id' =>',1,2,3,4,'
                                ),
                            ));
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
