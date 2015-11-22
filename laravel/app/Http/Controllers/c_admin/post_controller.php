<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\library\element;
use App\Models\Post;
use Input;

class post_controller extends generalController {

    public function show($lang = '') {
        return view("admin.v_posts", ["editor" => element::editor('newPost','', '320', $lang)]);
    }
}
