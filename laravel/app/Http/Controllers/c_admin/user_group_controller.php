<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\library\element;
use Input;
use App\Http\Controllers\generalController; //******
class user_group_controller extends generalController
{

     public function show() {
         return view("admin.v_user_group",
    ['multiSelect' => element::multiSelect("services", "title", "services", "","serv_id")]);
    }
 
}
