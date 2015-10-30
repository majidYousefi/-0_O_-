<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class userController extends Controller
{

    public function index()
    {
        return view('v_admin.panel');
    }
  
}
