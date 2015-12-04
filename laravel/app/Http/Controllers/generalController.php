<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;

use App\library\dialog;
use App\library\element;

define("Model", "App\Models\\");

class generalController extends Controller {

    public $model_obj;

    public function __construct($model_instance='User') {
        $model_instance = Model . $model_instance;
        $this->model_obj = new $model_instance();
    }

    public function add() {
        $this->model_obj->add();
    }
    public function edit() {
        $this->model_obj->edit();
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

    
    
    
    public function msg($msgId='0',$type='pd',$title='خطا')
    {
       return dialog::message($type,$title,dialog::$msg[$msgId]);
    }


    public function getListData() {
        $table = Input::get('table');
        $data = '';
        if (is_numeric($table)) {
            switch ($table):
                case 1:
                    $data = $this->test();
                    break;
            endswitch;
        }
        else {
            $data = $this->defaultList();
        }



        echo json_encode($data);
    }
    private function defaultList() {
        $table = Input::get('table');
        $attr = '';
        foreach (Input::get('attr') as $r) {
            $attr.=$r . ",";
        }
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        // print_r();die;
        $condition = Input::get('data');
        $data = DB::table($table)->select(Input::get('attr'))->
                        where(function($q) use ($condition) {
                            if (!empty($condition['data'])) {
                                foreach ($condition['data'] as $key => $value)
                                    $q->where($key, $condition['op'][$key], $value);
                            }
                        }
                        )->orderBy('id', 'desc')->
                        skip($from)->take($to)->get();



        $count = DB::table($table)->select(Input::get('attr'))->
                        where(function($q) use ($condition) {
                            if (!empty($condition['data'])) {
                                foreach ($condition['data'] as $key => $value)
                                    $q->where($key, $condition['op'][$key], $value);
                            }
                        }
                        )->get();
        $data['count'] = sizeof($count);
        return $data;
    }
    public function upload($serv_id) {
        ini_set('upload_max_filesize', '25M');
        ini_set('post_max_size', '25M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
        $add = [];
        foreach ($_FILES as $k => $file) {
            $filename = '';
            if (!empty($file['tmp_name'])) {

                $savingName = date('l  j / m / Y ');
                $fname = date('l-j-m-Y') . '-' . rand(1, 1000000);
                $size = $file['size'];
                $ftype = $file['type'];
                $temp = $file['tmp_name'];
                $type = array();
                $type = explode("/", $ftype);
                $directory = "galleries/" . $type[0] . "_gallery/orginal/" . $serv_id;
                if (!file_exists($directory))
                    mkdir($directory, 0777, true);

                $filename = $directory . "/" . $fname . "." . $type[1];
                $index = 0;
                while (file_exists($filename)) {
                    $filename = $directory . "/" . $fname . "($index)" . "." . $type[1];
                    $index++;
                }
                move_uploaded_file($temp, $filename);
            }
            $add[$k] = $filename;
        }
        return $add;
    }

}
