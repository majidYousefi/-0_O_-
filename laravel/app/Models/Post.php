<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\generalModel;

class Post extends generalModel {

    protected $table = 'posts';

    public function add() {
        dd(Input::all());
        $title = Input::get("f1");
        $body = Input::get("f2");
        $importer_id = Auth::user()['attributes']['id'];
        $this->title = $title;
        $this->body = $body;
        $this->importer_id = $importer_id;
        $this->save();
    }

    public function edit() {
        $t = $this::find(Input::get('id'));
        $t->title = Input::get("f1");
        $t->body = Input::get("f2");
        $t->save();
    }

    public function listx() {
        $cond = Input::get('data');
        $from = (NULL !== (Input::get('from'))) ? Input::get('from') : 0;
        $to = (NULL !== (Input::get('to'))) ? Input::get('to') : 10;
        $data = DB::select(DB::raw("SELECT "
                                . " id as f1,"
                                . " title as f2,"
                                . " body as f3"
                                . " FROM `$this->table`"
                                . " WHERE `title` LIKE '%" . $cond['s1'] . "%'"
                                . " AND `body` LIKE '%" . $cond['s2'] . "%'"
                                . " ORDER BY `id` DESC"
                                . " LIMIT $from,$to "
        ));

        foreach ($data as &$r)
            $r->f3 = mb_substr(strip_tags($r->f3), 0, 150, "utf-8");

        $count = DB::select(DB::raw("SELECT "
                                . " id "
                                . " FROM `$this->table`"
                                . " WHERE `title` LIKE '%" . $cond['s1'] . "%'"
                                . " AND  `body` LIKE '%" . $cond['s2'] . "%'"
        ));



        $data['count'] = sizeof($count);
        return ($data);
    }

    public function get() {
        return DB::select(DB::raw("SELECT "
                                . "title as f1,"
                                . "body as f2"
                                . " FROM `$this->table`"
                                . " WHERE id=" . Input::get('id')));
    }

}
