<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class ch_ProductsType_model extends generalModel {

    protected $table = "ch_products_type";
      
    public function add() {
        $this->title=Input::get("f1");
        return $this->save();
    }

    public function edit() {

        $t = $this::find(Input::get('id'));
        $t->title=Input::get("f1");
        return $t->save();
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
        $sql.=" ORDER BY id DESC LIMIT $from,$to";
        $data = DB::select(DB::raw($sql));
        $data['count'] = DB::select(DB::raw("SELECT FOUND_ROWS() as count"))[0]->count;
        return $data;
    }

    public function gc($index) {
   
        $title = Input::get('params');
        switch ($index) {
            case 1:
                return DB::select(DB::raw("SELECT "
                                        . "id as f1,"
                                        . "title as f2"
                                        . " FROM `$this->table`"
                                        . " WHERE title LIKE '%" . $title . "%'"));
                break;
        }
    }

}
