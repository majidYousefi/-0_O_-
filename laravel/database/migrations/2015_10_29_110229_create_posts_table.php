<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
      Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('importer_id');
            $table->string("title",250);
            $table->text('body');
            $table->string('sets_id',520);
            $table->integer('visted_number');
            $table->string('date',22);
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
      Schema::drop('posts');
    }
}
