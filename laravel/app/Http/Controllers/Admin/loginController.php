<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\User;
use Illuminate\Support\Facades\Auth;
class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function identify() {
        $username = htmlentities(Input::get("username"));
        $password = htmlentities(Input::get("password"));
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
             return redirect('panel');
        }
        return redirect('sys_admin');
    }


}
