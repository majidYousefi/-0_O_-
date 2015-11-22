<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;
use App\generalModel;
class Services extends generalModel
{
    protected $table = 'services';
    
        public function add() {
                $this->title = Input::get('f1');
                $this->save();
    }
    
         public function edit() {
                $t=$this::find(Input::get('id'));               
                $t->title = Input::get('f1');
                $t->save();
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "title as f1"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }
    
    
    
    
    
       public function listx() {
        $attr = ["id as f1", "title as f2"];
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');
        
        $data = DB::table($this->table)->select($attr)->
                        where("title", "like", "%" . $cond['s1'] . "%")->
                        where("id", "like", "%" . $cond['s2'] . "%")->
                        orderBy('id', 'desc')->
                        skip($from)->take($to)->get();

        $count = DB::table($this->table)->select($attr)->
                        where("title", "like", "%" . $cond['s1'] . "%")->
                        where("id", "like", "%" . $cond['s2'] . "%")->get();
        $data['count'] = sizeof($count);
        return json_encode($data);
    }
    

}
