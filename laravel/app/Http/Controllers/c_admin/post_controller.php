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
        
        /*
         *             Excel::create('Filename', function($excel) {

})->download('xlsx');
         */
        return view("admin.v_posts", ["editor" => $this->ed()
                ,"editor2" => $this->ed()]);
    }
       public function add() {
        
     dd(Input::get());
    }
    
}
