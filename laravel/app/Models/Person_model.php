<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class Person_model extends generalModel {

    protected $table = "person";

    public function add() {
        //put your code here
        $this->name = Input::get('f3');
        $this->family = Input::get('f4');
        $this->national_code = Input::get('f5');
        $this->address = Input::get('f10');
        $this->email = Input::get('f9');
        $this->mobile = Input::get('f7');
        $this->phone = Input::get('f6');
        $this->role_id = Input::get('f8');

        $this->save();
    }

    public function edit() {

        $t = $this::find(Input::get('id'));
        $t->name = Input::get('f3');
        $t->family = Input::get('f4');
        $t->national_code = Input::get('f5');
        $t->address = Input::get('f10');
        $t->email = Input::get('f9');
        $t->mobile = Input::get('f7');
        $t->phone = Input::get('f6');
        $t->role_id = Input::get('f8');
        return $t->save();
    }

    public function listx() {

        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS 
                id,name
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
        return DB::select(DB::raw("SELECT "
                                . "created_at as f1,"
                                . "updated_at as f2,"
                                . "name as f3,"
                                . "family as f4, "
                                . "national_code as f5,"
                                . "address  as f10,"
                                . "email as f9,"
                                . "mobile as f7, "
                                . "phone as f6,"
                                . "role_id  as f8"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }
    
        public function gc($index) {;
        $param=Input::get('params');
        switch ($index) {
            case 1:
                return DB::select(DB::raw("SELECT "
                                        . "id as f1,"
                                        . "CONCAT(name,' ',family) as f2"
                                        . " FROM `$this->table`"
                                        . " WHERE CONCAT(name,' ',family) LIKE '%" . $param . "%'"));

                break;
        }
    }

}
