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

    public function index($lang='') {

        return view("v_posts.editor", ["data" => element::editor("", "400", $lang)]);
    }

    public function addNewPost() {

        $title = Input::get("title");
        $body = "body";

        $importer_id = Auth::user()['attributes']['id'];
        echo 'xxx';
        $v = new Post();
        $v->title = $title;
        $v->body = $body;
        $v->importer_id = $importer_id;
        // $v->access_directory = $filename;
        $v->save();
    }

}
