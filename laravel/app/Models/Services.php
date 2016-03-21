<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;
use App\generalModel;

class Services extends generalModel {

    protected $table = 'services';
             
    function __construct() {
        
        $i='d3';
        $this->detail[$i]['table']='comment';
        $this->detail[$i]['add_fields']='name,title';
        $this->detail[$i]['edit_fileds']=['name','title'];
        $this->detail[$i]['select_fields']='id,name,title';
        
    }
    
    public function add() {
        $this->title = Input::get('f1');
        $this->controller = Input::get('f2');
        $this->model = Input::get('f3');
        $this->migrate = Input::get('f4');
        $this->view = Input::get('f5');
        $this->parent_id = Input::get('f6');
       return $this->save();
       
        
        //dd($this->addDetail());
        
     
    }

    public function edit() {
       $t = $this::find(Input::get('id'));
        $t->title = Input::get('f1');
        $t->controller = Input::get('f2');
        $t->model = Input::get('f3');
        $t->migrate = Input::get('f4');
        $t->view = Input::get('f5');
        $t->parent_id = Input::get('f6');
        return $t->save();
        //Input::get());
        //  dd($this->addDetail());
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "title as f1,"
                                . "controller as f2,"
                                . "model as f3,"
                                . "migrate as f4,"
                                . "view as f5,"
                                . "parent_id as f6,"
                               // . "'http://localhost/aprojects/laravel/public/uploads/image/jpeg/small/4_2016_02_4_1454617376.jpeg' as f7 "
                                .'4 as f7'
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }

    public function listx() {
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS
                id ,
                title   
                FROM `$this->table` 
                WHERE 1 ";
        if (!empty($cond['s1'])) {
            $sql.=" AND  id='{$cond['s1']}'";
        }
        if (!empty($cond['s2'])) {
            $sql.=" AND title LIKE '%" . $cond['s2'] . "%'";
        }
        //**********  
        $sql.="GROUP BY id ORDER BY id DESC LIMIT $from,$to";
        $data = DB::select(DB::raw($sql));
        $data['count'] = DB::select(DB::raw("SELECT FOUND_ROWS() as count"))[0]->count;
        return $data;
    }

    
    
    
     public function gc($index) {
         $title=Input::get('title');
         switch($index){
             case 1:
                   return DB::select(DB::raw("SELECT "
                                . "id as f1,"
                                . "title as f2"
                                . " FROM `$this->table`"
                                . " WHERE controller LIKE '%".$title."%'" ));
                 break;
                case 5:
                   return DB::select(DB::raw("SELECT "
                                . "id as f1,"
                                . "title as f2"
                                . " FROM `$this->table`"));
                 break;
             
         }
         
     }
     
   
}
