<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class News_model extends generalModel {

    protected $table = "news";
          function __construct() {
        
        $i='d1';
        $this->detail[$i]['table']='detail_1';
        $this->detail[$i]['forign_key']='f_id';
        $this->detail[$i]['add_fields']='title';
        $this->detail[$i]['edit_fileds']=['title'];
        $this->detail[$i]['select_fields']='id,title';
        
        $i='d2';
        $this->detail[$i]['table']='detail_2';
        $this->detail[$i]['forign_key']='f_id';
        $this->detail[$i]['add_fields']='title,number,date';
        $this->detail[$i]['edit_fileds']=['title','number'];
        $this->detail[$i]['select_fields']='id,title,number,date,"http://localhost/aprojects/laravel/public/uploads/image/jpeg/small/6_2016_03_19_8750537790.jpeg"';
                       
                       
    }
    
    public function add() {
        //put your code here
        $this->title=Input::get('f1');
        $this->save();
      //  $this->addDetail();
        return $this->id;
        
    }

    public function edit() {

        $t = $this::find(Input::get('id'));
       // echo"<pre>";print_r($t);die("sgfsgsgs");
         $t->title=Input::get('f1');
        return $t->save();
    }

    public function listx() {

        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS 
                id,
                title
                FROM `$this->table`
                WHERE 1 ";
        if (!empty($cond['s1'])) {
            $sql.=" AND  id='{$cond['s1']}'";
        }
        //**********       
        $sql.=" ORDER BY id DESC LIMIT $from,$to";
        $data = DB::select(DB::raw($sql));
        $data['count'] = DB::select(DB::raw("SELECT FOUND_ROWS() as count"))[0]->count;
        return $data;
    }

    public function get() {
        return DB::select(DB::raw("SELECT  
                           'f1' as f1,
                'f2' as f2,
                 '1^5' as f3,
                  'f4' as f4,
                   'f5' as f5,
                    '1' as f6,
                     'f7' as f7,
                      'f8' as f8,
                       'f9' as f9,
                       '2' as f11
                FROM `$this->table`"));
    }

}
