<?php

//************Controllers Within The "App\Http\Controllers\User" Namespace *****************
//
//************Group Without Auth MiddleWare
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
   Route::get("newPost/{lang?}", "postController@index");
      Route::post("addNewPost", "postController@addNewPost");
});

