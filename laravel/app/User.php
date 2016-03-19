<?php

namespace App;

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
        $this->user_group_id = Input::get('f4');
        $this->save();
    }

    public function edit() {
        $t = $this::find(Input::get('id'));
        $t->username = Input::get('f1');
        $t->user_group_id = Input::get('f4');
        $t->save();
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "username as f1,"
                                . "NULL as f2,"
                                . "NULL as f3,"
                                . "user_group_id as f4 "
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }



    public function listx() {
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $cond = Input::get('data');
        
        //****** قسمت هایی که باید تغییر بکند. بالا و پایین همیسشه ثایته
        $sql = "SELECT SQL_CALC_FOUND_ROWS
                a.id as f1,
                a.username as f2,
                SUBSTR(GROUP_CONCAT(ug.title),1,150) as f3
                FROM `$this->table` a
                LEFT JOIN user_group ug on (FIND_IN_SET(ug.id,a.user_group_id))
                WHERE 1 ";
        if (!empty($cond['s1'])) {
            $sql.=" AND  a.id='{$cond['s1']}'";
        }
        if (!empty($cond['s2'])) {
            $sql.=" AND a.username LIKE '%" . $cond['s2'] . "%'";
        }
        //**********
        
        $sql.="GROUP BY a.id ORDER BY a.id DESC LIMIT $from,$to";
        $data = DB::select(DB::raw($sql));
        $data['count'] = DB::select(DB::raw("SELECT FOUND_ROWS() as count"))[0]->count;
        return json_encode($data);
    }

}
