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
    Route::get("panel",function () {return view('admin.panel');});
    Route::get("newUser", "userController@newUser");
      Route::get("userList","userController@userList");
  
});



//******************DEFUALT**************
