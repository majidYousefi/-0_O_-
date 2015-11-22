<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use Input;
use Hash;
use App\generalModel;
class User extends generalModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function add() {
                $this->username = Input::get('f1');
                $this->password = Hash::make(Input::get('f2'));
                $this->email = Input::get('f5');
                $this->remember_token=Input::get('files')['u1'];
                $this->save();
    }
    
     public function edit() {
                $t=$this::find(Input::get('id'));               
                $t->username = Input::get('f1');
                $t->password = Hash::make(Input::get('f2'));
                $t->email = Input::get('f5');
                $t->save();
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "username as f1,"
                                . "NULL as f2,"
                                . "Null as f3,"
                                . "1 as f4,"
                                . "NULL as f5,"
                                . "email as f6,"
                                . "password as f7,"
                                . "1 as f8"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }
 
    public function delete() {
        DB::table($this->table)->where('id', '=', Input::get('id'))->delete();
    }

    
    
       public function listx() {
        $attr = ["id as f1", "username as f2", "password as f3", "email as f4"];
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');
        
        $data = DB::table($this->table)->select($attr)->
                        where("username", "like", "%" . $cond['s1'] . "%")->
                        where("id", "like", "%" . $cond['s2'] . "%")->
                        orderBy('id', 'desc')->
                        skip($from)->take($to)->get();

        $count = DB::table($this->table)->select($attr)->
                        where("username", "like", "%" . $cond['s1'] . "%")->
                        where("id", "like", "%" . $cond['s2'] . "%")->get();
        $data['count'] = sizeof($count);
        return json_encode($data);
    }
}
