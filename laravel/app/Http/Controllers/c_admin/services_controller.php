<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Services;
use Input;
class services_controller extends Controller
{
    public $model_obj;

    public function __construct() {
        $this->model_obj = new Services();
    }
    public function show()
    {
        return view("admin.v_services");
    }


     public function add() {
        if (!empty(trim(Input::get('f1')))) {
                $this->model_obj->add();     
        } else
            return dialog::message("ls", "هشدار", "نام کاربری نمی تواند خالی باشد.");
    }
    
        public function edit() {
      if (!empty(trim(Input::get('f1')))) {
                $this->model_obj->edit();     
        } else
            return dialog::message("ls", "هشدار", "نام کاربری نمی تواند خالی باشد.");
    }
    
    
    
    
      public function get() {

        return $this->model_obj->get();
    }
    public function listx()
    {
         return $this->model_obj->listx();
    }
       public function delete() {
        $this->model_obj->delete();
    }

}
