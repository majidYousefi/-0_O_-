<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChProductsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                Schema::create('ch_products_images', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer("ch_products_id");
            $table->string("path", 250);
            $table->tinyInteger("is_main");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('ch_products_images');
    }
}
