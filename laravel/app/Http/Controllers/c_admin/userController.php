<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use App\User;

class userController extends Controller {

    public function index() {
        return view('v_admin.panel');
    }

    public function addNewUser() {
        if (Input::get('password') == Input::get('re_password')) {
            $user = new User();
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
        }
        else
            return "تکرار پسسورد اشتباست";
    }

}
