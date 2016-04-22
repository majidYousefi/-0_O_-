<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use App\Models\Services;
use Input;
use Session;
use DB;

class services_controller extends generalController {

    public function add() {

        $this->rules(['f1' => "required", 'f2' => "required", 'f3' => "required", 'f4' => "required", 'f5' => "required", 'f6' => "required"]);
        $this->model_obj->add();
        if (Input::get('f7') == '1') {
            $controllerFileName = "../app/Http/Controllers/c_admin/" . Input::get('f2') . ".php";
            if (!file_exists($controllerFileName)) {
                file_put_contents($controllerFileName, str_replace('ViewPage', '"admin.' . Input::get('f5') . '"', str_replace('sample', Input::get('f2'), file_get_contents("../app/Http/Controllers/sampleController.php"))));
            }
            $modelFileName = "../app/Models/" . Input::get('f3') . ".php";
            if (!file_exists($modelFileName)) {
                file_put_contents($modelFileName, str_replace('tableName', '"' . Input::get('f4') . '"', str_replace('sample', Input::get('f3'), file_get_contents("../app/sampleModel.php"))));
            }
            $migrateFileName = "../database/migrations/" . date("Y_m_d_His") . "_create_" . Input::get('f4') . "_table.php";
            if (!file_exists($migrateFileName)) {
                file_put_contents($migrateFileName, str_replace("tableName", "'" . Input::get('f4') . "'", str_replace('sample', "Create" . preg_replace('/\s+/', '', ucwords(str_replace("_", " ", Input::get('f4')))) . "Table", file_get_contents("../database/sampleMigrate.php"))));
            }
            $viewFileName = "../resources/views/admin/" . Input::get('f5') . ".php";
            if (!file_exists($viewFileName)) {
                file_put_contents($viewFileName, file_get_contents("../resources/views/sampleView.php"));
            }
        }
    }

    public function edit() {
        $this->rules(['f1' => "required", 'f2' => "required", 'f3' => "required", 'f4' => "required", 'f5' => "required", 'f6' => "required"]);
        $this->model_obj->edit();
        if (Input::get('f7') == '1') {
            $controllerFileName = "../app/Http/Controllers/c_admin/" . Input::get('f2') . ".php";
            if (!file_exists($controllerFileName)) {
                file_put_contents($controllerFileName, str_replace('ViewPage', '"admin.' . Input::get('f5') . '"', str_replace('sample', Input::get('f2'), file_get_contents("../app/Http/Controllers/sampleController.php"))));
            }
            $modelFileName = "../app/Models/" . Input::get('f3') . ".php";
            if (!file_exists($modelFileName)) {
                file_put_contents($modelFileName, str_replace('tableName', '"' . Input::get('f4') . '"', str_replace('sample', Input::get('f3'), file_get_contents("../app/sampleModel.php"))));
            }
            $migrateFileName = "../database/migrations/" . date("Y_m_d_His") . "_create_" . Input::get('f4') . "_table.php";
            if (!file_exists($migrateFileName)) {
                file_put_contents($migrateFileName, str_replace("tableName", "'" . Input::get('f4') . "'", str_replace('sample', "Create" . preg_replace('/\s+/', '', ucwords(str_replace("_", " ", Input::get('f4')))) . "Table", file_get_contents("../database/sampleMigrate.php"))));
            }
            $viewFileName = "../resources/views/admin/" . Input::get('f5') . ".php";
            if (!file_exists($viewFileName)) {
                file_put_contents($viewFileName, file_get_contents("../resources/views/sampleView.php"));
            }
        }
    }

    private function updateServiceSession() {
        $services = array();
        $result = DB::select(DB::raw("SELECT id,controller,model,view FROM services "));
        foreach ($result as $res) {
            $services[$res->id]['controller'] = $res->controller;
            $services[$res->id]['model'] = $res->model;
            $services[$res->id]['view'] = $res->view;
        }
        Session::flush('services');
        Session::put('services', $services);
        dd($services);
    }

}
