<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::any("getView/{page}", function ($page) {
        return view("$page");
    });

    Route::post("listData", "generalController@getListData");
    Route::get("getListExcel", "generalController@getListExcel");
    Route::post("services/{servId}/{servActn}/{extra?}", "manager@detect");
    Route::post("upload/{servId}", "generalController@upload");
    Route::post("removeUpload", "generalController@removeUpload");
    Route::get("services/{servId}/{servActn}/{extra?}", ['middleware' => 'serv_acc', "uses" => "manager@detect"]);
});




Route::get('sys_admin', function () {
    return view('v_users.login');
});


//************Group Without Auth MiddleWare
Route::group(['namespace' => 'c_admin'], function () {
    Route::post('userLogin', "signController@login");
});
Route::group(['namespace' => 'c_admin'], function () {
    Route::get("userLogout", "signController@logout");
});




//----------------------------USER CONTROLLER
//************Group WITH Auth MiddleWare
//
//******************GET***********
Route::group(['middleware' => 'auth', 'namespace' => 'c_admin'], function () {
    Route::get("panel", "signController@getServicesAndShowPanel");
});
