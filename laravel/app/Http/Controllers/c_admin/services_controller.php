<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use App\Models\Services;
use Input;

class services_controller extends generalController {

    public $model_obj;

    public function __construct() {
        $this->model_obj = new Services();
    }

    public function show() {
        return view("admin.v_services");
    }

    public function add() {

        if (empty(trim(Input::get('f1'))) || empty(trim(Input::get('f2'))) || empty(trim(Input::get('f3'))) || empty(trim(Input::get('f4'))))
            return $this->msg();

        $res = $this->model_obj->add();
        if (is_null($res)) {
            $controllerFileName = "../app/Http/Controllers/c_admin/" . Input::get('f2') . ".php";
            if (!file_exists($controllerFileName)) {
                file_put_contents($controllerFileName, str_replace('sample', Input::get('f2'), file_get_contents("../app/Http/Controllers/sampleController.php")));
            }
            $modelFileName = "../app/Models/" . Input::get('f3') . ".php";
            if (!file_exists($modelFileName)) {
                file_put_contents($modelFileName, str_replace('sample', Input::get('f3'), file_get_contents("../app/sampleModel.php")));
            }
            $migrateFileName = "../database/migrations/" . date("Y_m_d_His") . "_create_" . Input::get('f4') . "_table.php";
            if (!file_exists($migrateFileName)) {
                file_put_contents($migrateFileName, str_replace("tableName", "'" . Input::get('f4') . "'", str_replace('sample', "Create" . preg_replace('/\s+/', '', ucwords(str_replace("_", " ", Input::get('f4')))) . "Table", file_get_contents("../database/sampleMigrate.php"))));
            }
        }
        //return dialog::message("ls", "هشدار", "نام کاربری نمی تواند خالی باشد.");
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

    public function listx() {
        return $this->model_obj->listx();
    }

    public function delete() {
        $this->model_obj->delete();
    }

}
