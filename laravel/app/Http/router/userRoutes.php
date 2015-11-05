<?php

//************Controllers Within The "App\Http\Controllers\User" Namespace *****************
//

//
//------------------------------SIGN_CONTROLLER ROUTERS

//************Group Without Auth MiddleWare
Route::group(['namespace' => 'c_admin'], function () {
    Route::post('userLogin', "signController@login");
});
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
    Route::get("userLogout", "signController@logout"); 
});





//----------------------------USER CONTROLLER

//************Group WITH Auth MiddleWare
//
//******************GET***********
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
    Route::get("panel", "userController@index");
    Route::get("userLogout", "signController@logout");
    Route::get("newUser", "userController@newUser");
  
});

//******************POST**********
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
    Route::post("addNewUser", "userController@addNewUser");
    Route::post("upload", "userController@upload");
});



//******************DEFUALT**************
Route::get('sys_admin', function () {
    return view('v_users.login');
});
