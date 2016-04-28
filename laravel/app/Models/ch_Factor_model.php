<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class ch_Factor_model extends generalModel {

    protected $table = "ch_factor";
                function __construct() {
        
        $i='d1';
        $this->detail[$i]['table']='ch_factor_pros';
        $this->detail[$i]['forign_key']='ch_factor_id';
        $this->detail[$i]['add_fields']='ch_products_id,amount,price';
        $this->detail[$i]['edit_fileds']=['ch_products_id','amount','price'];
        $this->detail[$i]['select_fields']='id,ch_products_id,amount,price';
    }
    public function add() {
        //put your code here
          $this->person_id=Input::get("f3");
        return $this->save();
    }

    public function edit() {

        $t = $this::find(Input::get('id'));
         $t->person_id=Input::get("f3");
        return $t->save();
    }

    public function listx() {

        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS 
                id
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
                               . "CONCAT(person_id,'^','x') as f3"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }
    

}
