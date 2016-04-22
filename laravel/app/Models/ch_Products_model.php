<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class ch_Products_model extends generalModel {

    protected $table = "ch_products";

    function __construct() {
        //parent::__construct();
        $i = 'd1';
        $this->detail[$i]['table'] = 'ch_products_images';
        $this->detail[$i]['forign_key'] = 'ch_products_id';
        $this->detail[$i]['add_fields'] = 'path,is_main';
        $this->detail[$i]['edit_fileds'] = ['path', 'is_main'];
        $this->detail[$i]['select_fields'] = 'id,path,is_main';
    }

    public function add() {
        $this->title = Input::get("f3");
        $this->code = Input::get("f4");
        $this->price_rial = Input::get("f5");
        $this->price_yoan = Input::get("f6");
        $this->price_dollar = Input::get("f7");
        $this->amount = Input::get("f8");
        $this->ch_products_type_id = Input::get("f9");
        $this->description = Input::get("f10");
        return $this->save();
    }

    public function edit() {

        $t = $this::find(Input::get('id'));
        $t->title = Input::get("f3");
        $t->code = Input::get("f4");
        $t->price_rial = Input::get("f5");
        $t->price_yoan = Input::get("f6");
        $t->price_dollar = Input::get("f7");
        $t->amount = Input::get("f8");
        $t->ch_products_type_id = Input::get("f9");
        $t->description = Input::get("f10");
        return $t->save();
    }

    public function listx() {

        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS 
                id ,title
                FROM `$this->table`
                WHERE 1 ";
        if (!empty($cond['s1'])) {
            $sql.=" AND  id='{$cond['s1']}'";
        }
        if (!empty($cond['s2'])) {
            $sql.=" AND  code='{$cond['s2']}'";
        }
        if (!empty($cond['s3'])) {
            $sql.=" AND  title LIKE'%{$cond['s3']}%'";
        }
        if (!empty($cond['s4'])) {
            $sql.=" AND  ch_products_type_id='{$cond['s4']}'";
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
                                . "title as f3,"
                                . "code as f4,"
                                . "price_rial as f5,"
                                . "price_yoan as f6,"
                                . "price_dollar as f7,"
                                . "amount as f8,"
                                . "ch_products_type_id as f9,"
                                . "description as f10"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }

}
