<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\library\element;
use App\Post;
use Input;

class postController extends Controller {

    public function newPost($lang = '') {

        return view("v_posts.NewPost", ["editor" => element::editor('newPost','', '320', $lang)]);
    }

    public function addNewPost() {
        $title = Input::get("title");
        $body = Input::get("body");
        $importer_id = Auth::user()['attributes']['id'];
        $v = new Post();
        $v->title = $title;
        $v->body = $body;
        $v->importer_id = $importer_id;
        $v->save();
    }

}
