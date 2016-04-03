<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;
use App\generalModel;

class UserGroup extends generalModel {

    protected $table = 'user_group';

    public function add() {
        $this->title = Input::get('f1');
        $this->services_id = Input::get('f2');
        $this->save();
    }

    public function edit() {
        $t = $this::find(Input::get('id'));
        $t->title = Input::get('f1');
        $t->services_id = Input::get('f2');
        return $t->save();
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "title as f1,"
                                . "services_id as f2"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }

    public function listx() {


        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');

        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS
                 id,title,services_id 
                FROM `$this->table` 
                WHERE 1 ";
        if (!empty($cond['s1'])) {
            $sql.=" AND  title LIKE '%" . $cond['s1'] . "%' ";
        }

        //**********

        $sql.="GROUP BY id ORDER BY id DESC LIMIT $from,$to";
        $data = DB::select(DB::raw($sql));
        $data['count'] = DB::select(DB::raw("SELECT FOUND_ROWS() as count"))[0]->count;
        return ($data);
    }

    public function gc($index) {
        $title = Input::get('title');
        $d_id=Input::get('d_id');
        switch ($index) {
            case 1:
                return DB::select(DB::raw("SELECT "
                                        . "id as f1,"
                                        . "title as f2"
                                        . " FROM `$this->table`"
                                        . " WHERE title LIKE '%" . $title . "%'"));

                break;
               case 2:
                return DB::select(DB::raw("SELECT "
                                        . "id as f1,"
                                        . "title as f2"
                                        . " FROM `$this->table`"
                                        . " WHERE id LIKE '%" . $d_id . "%'"));

                break;
        }
    }

}
