<?php

//************Controllers Within The "App\Http\Controllers\User" Namespace *****************
//
//************Group Without Auth MiddleWare
Route::group(['middleware' => 'auth', 'namespace' => 'c_post'], function () {
   Route::get("postAdd", "postController@index");
});

