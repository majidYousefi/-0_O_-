<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;
use App\generalModel;
class UserGroup extends generalModel
{
        protected $table = 'user_group';
           public function add() {
                $this->title = Input::get('f1');
                $this->services_id = Input::get('f2');
                $this->save();
    }
    
         public function edit() {
                $t=$this::find(Input::get('id'));               
                $t->title = Input::get('f1');
                $t->services_id=Input::get('f2');
                $t->save();
    }
    
    
    public function get() {
                return DB::select(DB::raw("SELECT "
                                . "title as f1,"
                                . "services_id as f2"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }
        public function listx() {
        $attr = ["id as f1", "title as f2", "services_id as f3"];
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');
        
        $data = DB::table($this->table)->select($attr)->
 
                        orderBy('id', 'desc')->
                        skip($from)->take($to)->get();

        $count = DB::table($this->table)->select($attr)->
                     get();
        $data['count'] = sizeof($count);
        return json_encode($data);
    }
    
  

}
