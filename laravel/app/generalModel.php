<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;

class generalModel extends Model {

    public function add() {
        
    }

    public function edit() {
        
    }

    public function listx() {
        //  return json_encode($data);
    }

    public function get() {
        
    }

    public function delete() {
        DB::table($this->table)->where('id', '=', Input::get('id'))->delete();
    }

}
