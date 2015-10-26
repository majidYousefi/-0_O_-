<?php

namespace App\Http\Controllers\c_post;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
class postController extends Controller
{
    public function add_post()
    {
        echo '<pre>'; print_r(Auth::user());
    }
   
}
