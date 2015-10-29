<?php

namespace App\Http\Controllers\c_post;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use  App\library\editor;
class postController extends Controller {



    public function index() {

        return view("v_posts.editor", ["data" => editor::get("", "400", 'en')]);
    }

    

}
