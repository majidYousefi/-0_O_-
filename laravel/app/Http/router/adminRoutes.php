<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('sys_admin', function () {
    return view('admin.login');
});




 Route::post('userLogin', "Admin\signController@login");
Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get("panel", "userController@index");
    
   
    Route::get("userLogout", "signController@logout");

});

