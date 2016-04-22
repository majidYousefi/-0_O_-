<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{

        public function up()
    {
      Schema::create('person', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->string("name",50);         
              $table->string("family",100);  
              $table->string("national_code",11); 
              $table->string("address",550); 
               $table->string("email",150); 
               $table->string("mobile",30); 
               $table->string("phone",30); 
               $table->smallInteger("role_id");
               
               
            $table->timestamps();
        });
    }
    public function down()
    {
      Schema::drop('person');
    }
}
