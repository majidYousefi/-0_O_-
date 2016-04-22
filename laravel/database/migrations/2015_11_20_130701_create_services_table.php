<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string("title", 250);
            $table->integer('serv_id');
            $table->string("controller", 100);
            $table->string("model", 100);
            $table->string("migrate", 100);
            $table->string("view", 100);
            $table->integer('creator_id');
            $table->string('parent_id');
            $table->timestamps();
        });
                      DB::table('services')->insert(
                        array(
                                array(
                                        'title' => 'کاربران',
                                    'controller'=>'user_controller',
                                     'model'=>'User',
                                     'migrate'=>'User',
                                     'view'=>'v_user'
                                    
                                ),
                              array(
                                        'title' => 'گروه کاربری',
                                       'controller'=>'user_group_controller',
                                     'model'=>'UserGroup_model',
                                     'migrate'=>'user_group',
                                     'view'=>'v_user_group'
                                ),
                              array(
                                        'title' => 'گروه سرویس',
                                       'controller'=>'service_group_controller',
                                     'model'=>'ServiceGroup_model',
                                     'migrate'=>'service_group',
                                     'view'=>'v_service_group'
                                ),
                              array(
                                        'title' => 'سرویس',
                                       'controller'=>'services_controller',
                                     'model'=>'Services_model',
                                     'migrate'=>'services',
                                     'view'=>'v_services'
                                ),
                            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('services');
    }

}
