<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use Input;
use Hash;
use App\library\element;

class user_controller extends generalController {

    public function show() {
        return view("admin.v_user", ['autoComplete' => element::autoComplete("posts", "title", "username", ""),
            'multiSelect' => element::multiSelect("user_group", "title", "userGroup", ""),
        ]);
    }

    public function add() {
        if (!empty(trim(Input::get('f1')))) {
         //   if ((Input::get('f2') == Input::get('f3')) && (!empty(trim(Input::get('f2'))))) {
                $this->model_obj->add();
          //  } else
            //    return $this->msg("error");
        } else
            return $this->msg(0);
    }

    public function edit() {
        if (!empty(trim(Input::get('f1')))) {
        //    if ((Input::get('f2') == Input::get('f3')) && (!empty(trim(Input::get('f2'))))) {
                $this->model_obj->edit();
          //  } else
          //      return dialog::message("pd", "خطا", "تکرار رمز عبور اشتباه وارد شده است.");
        } else
            return dialog::message("ls", "هشدار", "نام کاربری نمی تواند خالی باشد.");
    }

    public function get() {

        return $this->model_obj->get();
    }

    public function listx() {
        return $this->model_obj->listx();
    }

    public function delete() {
        $this->model_obj->delete();
    }

    public function userList() {
        return view("v_users.UserLists", ["at1" => element::autoComplete("posts", "title", "s-title")]);
    }

}
