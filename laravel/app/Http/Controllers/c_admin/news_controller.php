<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use Input;
use Hash;
use App\library\element;

class news_controller extends generalController {


    public function add() {
        echo"<pre>";print_r(Input::get());die;
        $this->model_obj->add();
    }

    public function edit() {
        $this->model_obj->edit();
    }

    public function get() {

        return $this->model_obj->get();
    }

    public function listx() {
       // dd(Input::get());
        return ($this->model_obj->listx());
    }

}
