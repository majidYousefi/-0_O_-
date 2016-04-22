<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use App\library\dialog;
use App\library\element;
use Validator;
use Mail;
use Excel;
define("Model", "App\Models\\");
use Session;
class generalController extends manager {

    public $model_obj;
    public $request;
    public $email_to;
    public $email_subject;
    public $serv_id;
    public function __construct($model_instance = 'User',$serv_id='') {
        $model_instance = Model . $model_instance;
        $this->request = '';
        $this->model_obj = new $model_instance();
        $this->serv_id=$serv_id;
    }

    public function show($view) {
        require_once "../resources/views/admin/$view.php";
        $form_titles = [];
        foreach ($config['form_elements'] as $row)
            $form_titles[$row['id']] = $row['title'];
        session([$config['serv_id'] => $form_titles]);
        return $config;
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

    public function getDetail() {
        return $this->model_obj->getDetail();
    }

    public function listx() {
        return $this->model_obj->listx();
    }

    public function delete() {
        $this->model_obj->delete();
    }

    public function gc($id) {
        return $this->model_obj->gc($id);
    }

    public function addDetail() {
        return $this->model_obj->addDetail();
    }

    public function msg($msgId = '0', $type = 'pd', $title = 'خطا') {
        print_r(dialog::message($type, $title, $msgId));
    }

    public function rules($params, $serv_id = '', $titlex = '') {
       
        $validator = Validator::make(Input::all(), $params);
        if ($validator->fails()) {
            $errors = array_unique(array_flatten(json_decode(json_encode($validator->errors()), 1)));

        if(!empty(session($serv_id)))
            foreach ($errors as &$er)
              foreach(session($serv_id) as $k=>$t)
                 $er=str_replace($k,$t,$er);
        
           $this->msg(implode("<br>", $errors));
            exit();
        }
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
        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);

        $file = $_FILES['userfile'];
        //echo"<pre>";print_r($file);die("sms");
        //  foreach ($_FILES as $k => $file) {
        $filename = '';
        if (!empty($file['tmp_name'])) {
            $savingName = date('l  j / m / Y ');
            $fname = $serv_id . "_" . date('Y_m_j') . '_' . time() * rand(1, 6);
            $size = $file['size'];
            $ftype = $file['type'];
            $temp = $file['tmp_name'];
            $type = array();
            $type = explode("/", $ftype);
            $image_folder = ($type[0] == 'image') ? 'original' : '';
            $directory = "uploads/" . $type[0] . "/" . $type[1] . "/$image_folder";
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            if ($type[0] == 'image') {
                $type[1] = (($type[1] == 'jpeg') || ($type[1] == 'jpg') || ($type[1] == 'bmp') || ($type[1] == 'png') || ($type[1] == 'gif')) ? $type[1] : 'jpeg';
                $tumbnale = $this->resize($file, $fname, $type[1]);
            }
            $filename = $directory . "/" . $fname . "." . $type[1];
            move_uploaded_file($temp, $filename);
        }
        //   $add[$k] = $filename;
        //  }

        if ($type[0] == 'image')
            $filename = $tumbnale;

        print_r(url($filename));
        // return $add;
    }

    private function resize($file, $fname, $type) {
        $temp = $file['tmp_name'];
        $src = '';
        switch ($type) {
            case 'jpeg':
            case 'jpg':
                $src = imagecreatefromjpeg($temp);
                break;
            case 'png':
                $src = imagecreatefrompng($temp);
                break;
            case 'bmp':
                $src = imagecreatefromwbmp($temp);
                break;
            case 'gif':
                $src = imagecreatefromgif($temp);
                break;
            default:
                $src = imagecreatefromjpeg($temp);
                break;
        }
        $directory = "uploads/image/" . $type . "/small/";
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $filename = $directory . $fname . "." . $type;
        imagejpeg($src, $filename, 30);
        imagedestroy($src);
        return $filename;
    }

    public function removeUpload() {
        $filename = Input::get('file_path');
        $strpos = strpos($filename, 'uploads/');
        $imagepos = strpos($filename, '/image/');
        if (is_numeric($imagepos)) {
            $filename_1 = (str_replace('small', 'original', $filename));
            unlink(substr($filename_1, $strpos));
        }
        unlink(substr($filename, $strpos));
    }

    //multiSelect
    public function ms($table, $att, $name = '', $required = '') {
        return element::multiSelect($table, $att, $name, $required);
    }

    //Editor
    public function ed($width = '900', $height = '130', $lang = '') {

        return element::editor('', $width, $height, $lang);
    }

    //Select getData GDD
    public function gd($serv_id, $gc_number, $json_encode = FALSE, $required = FALSE) {
        return element::autoCombo($this->detect($serv_id, 'gc', $gc_number, $json_encode), $required);
    }

    //Get Excel From List
    public function getListExcel($titles) {
        $GLOBALS['titles']=array_flatten($titles);
        Excel::create('Filename', function($excel) {
            $excel->sheet('Sheetname', function($sheet) {
                $sheet->setAutoSize(true);
                $data = array_reverse(json_decode(json_encode($this->listx()), true));
                unset($data['count']);
                $sheet->row(1,$GLOBALS['titles']);
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->export('xlsx');
    }

    public function runEvent($even_name) {
        $even_name = "App\Events\\" . "$even_name";
        event(new $even_name);
    }

    public function sendMail($text_or_viewFile,$exhangeValue,$to,$subject) {
        $this->to=$to;
        $this->email_subject=$subject;
        if (is_array($exhangeValue)) {
            Mail::send('email', ['key' => 'value'], function($message) {
                $message->to($this->to)->subject($this->email_subject);
            });
        } else {
   
            Mail::raw('متن ی', function($message) {
                  $message->to($this->to)->subject($this->email_subject);
            });
        }
    }
    public function pd($param){
        echo"<pre>";print_r($param);die;
    }

}
