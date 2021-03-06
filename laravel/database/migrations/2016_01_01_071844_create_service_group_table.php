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
             $table->smallInteger('top_menu');
        });
                          DB::table('service_group')->insert(
                        array(
                                array(
                                        'title' => 'سیستم'
                                ),
                               array(
                                        'title' => 'سرویس های عمومی'
                                ),
                            ));
    }
    public function down()
    {
      Schema::drop('service_group');
    }
}
