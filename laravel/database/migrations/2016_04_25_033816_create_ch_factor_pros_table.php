<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChFactorProsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ch_factor_pros', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
             $table->integer("ch_factor_id"); 
              $table->integer("person_id"); 
              $table->string("price",50); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ch_factor_pros');
    }
}
