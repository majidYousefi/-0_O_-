<?php

//************Controllers Within The "App\Http\Controllers\User" Namespace *****************
//
//************Group Without Auth MiddleWare
Route::group(['namespace' => 'c_admin'], function () {
    Route::post('userLogin', "signController@login");
});

//************Group WITH Auth MiddleWare
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
    Route::get("panel", "userController@index");
    Route::get("userLogout", "signController@logout");
     Route::post("addNewUser", "userController@addNewUser");

});

Route::get('sys_admin', function () {
    return view('v_users.login');
});
