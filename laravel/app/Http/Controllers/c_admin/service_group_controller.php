<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use Input;
use Hash;
use App\library\element;

class service_group_controller extends generalController {



    public function add() {
        $this->rules(['f1'=>"required"],$this->serv_id);
        $this->model_obj->add();
    }

    public function edit() {
        $this->rules(['f1'=>"required"],$this->serv_id);
        $this->model_obj->edit();
    }
}
