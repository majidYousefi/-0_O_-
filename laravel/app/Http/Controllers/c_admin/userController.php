<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use App\User;
use App\library\dialog;

class userController extends Controller {

    public function index() {
        return view('v_admin.panel');
    }

    public function addNewUser() {
        if (!empty(trim(Input::get('username')))) {
            if ((Input::get('password') == Input::get('re_password')) && (!empty(trim(Input::get('password'))))) {
                $user = new User();
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->save();
            } else
                return dialog::message("d", "خطا", "تکرار رمز عبور اشتباه وارد شده است.");
        } else
            return dialog::message("w", "هشدار", "نام کاربری نمی تواند خالی باشد.");
    }

}
