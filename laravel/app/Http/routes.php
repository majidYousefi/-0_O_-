<?php
require_once 'router/userRoutes.php';

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
    
        Route::post("listData","generalController@getListData");
     
    
       Route::post("services/{servId}/{servActn}","manager@detect");
       Route::post("upload/{servId}", "generalController@upload");
    
});




Route::get('sys_admin', function () {
    return view('v_users.login');
});
