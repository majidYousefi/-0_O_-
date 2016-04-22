<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChProductsTable extends Migration {

    public function up() {
        Schema::create('ch_products', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string("title", 250);
            $table->integer("code");
            $table->string("price_rial", 100);
            $table->string("price_yoan", 100);
            $table->string("price_dollar", 100);
            $table->integer("amount");
            $table->smallInteger("ch_products_type_id");
            $table->text("description" );
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('ch_products');
    }

}
