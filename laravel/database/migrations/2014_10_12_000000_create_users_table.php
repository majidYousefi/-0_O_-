<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('username');
            $table->string('email');
            $table->string('password', 60);
            $table->string('user_group_id',520);
            $table->rememberToken();
            $table->timestamps();
            
        });
          DB::table('users')->insert(
                        array(
                                array(
                                        'username' => 'a',
                                        'password' => Hash::make('1'),
                                        'user_group_id'=>',1,'
                                )
                            ));
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
