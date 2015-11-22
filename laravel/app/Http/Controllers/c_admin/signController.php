<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class signController extends Controller
{

    public function login() {
        $username = htmlentities(Input::get("username"));
        $password = htmlentities(Input::get("password"));
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
             return redirect('panel');
        }
        return redirect('sys_admin');
    }
    public function logout() {
        Auth::logout();
        return redirect('sys_admin');
    }


}
