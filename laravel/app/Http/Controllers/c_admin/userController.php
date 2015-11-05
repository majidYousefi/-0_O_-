<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use App\User;
use App\library\dialog;
use App\library\element;
use DB;

class userController extends Controller {

    public function index() {
        return view('v_admin.panel');
    }

    public function addNewUser() {
        if (!empty(trim(Input::get('username')))) {
            if ((Input::get('password') == Input::get('re_password')) && (!empty(trim(Input::get('password'))))) {
                $user = new User();
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->save();
            } else
                return dialog::message("pd", "خطا", "تکرار رمز عبور اشتباه وارد شده است.");
        } else
            return dialog::message("ls", "هشدار", "نام کاربری نمی تواند خالی باشد.");
    }

    public function newUser() {


        return view("v_users.NewUser", ['autoComplete' => element::autoComplete("posts", "title", "username", "required")]);
    }

    public function upload() {
        ini_set('upload_max_filesize', '25M');
        ini_set('post_max_size', '25M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
        foreach ($_FILES as $file) {
            if (!empty($file['tmp_name'])) {
                $savingName = date('l  j / m / Y ');
                $fname = date('l-j-m-Y') . '-' . rand(1, 1000000);
                $size = $file['size'];
                $ftype = $file['type'];
                $temp = $file['tmp_name'];
                $type = array();
                $type = explode("/", $ftype);
                $filename = "galleries/" . $type[0] . "_gallery/" . $fname . "." . $type[1];
                $index = 0;
                while (file_exists($filename)) {
                    $filename = "galleries/" . $type[0] . "_gallery/" . $fname . "($index)" . "." . $type[1];
                    $index++;
                }
                move_uploaded_file($temp, $filename);
            }
        }
    }

}
