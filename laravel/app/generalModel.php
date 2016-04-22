<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Http\Controllers\manager;

class generalModel extends Model {

    public $detail;
    function __construct() {
         date_default_timezone_set('Asia/Tehran');
    }

    public function add() {
        
    }

    public function edit() {
        
    }

    public function listx() {
        //  return json_encode($data);
    }

    public function get() {
        
    }

    public function getDetail() {
        if (isset($this->detail) && !empty($this->detail)) {
            $data['details'] = array();
            foreach ($this->detail as $key => $detail) {
                $data['details'][$key] = json_decode(json_encode(DB::select(DB::raw("SELECT {$detail['select_fields']}"
                                                . " FROM `{$detail['table']}`"
                                                . " WHERE `{$detail['forign_key']}` = '" . Input::get('id') . "'"))), 1);
                foreach ($data['details'][$key] as $k => &$row)
                    $row = array_values($row);
            }
            return $data;
        }
    }

    public function delete() {
        return DB::table($this->table)->where('id', '=', Input::get('id'))->delete();
    }

    public function gc($index) {
        $title = Input::get('params');
        switch ($index) {
            case 1:
                return DB::select(DB::raw("SELECT "
                                        . "id as f1,"
                                        . "title as f2"
                                        . " FROM `$this->table`"
                                        . " WHERE title LIKE '%" . $title . "%'"));
                break;
        }
    }

    public function addDetail() {
        //   echo"<pre>";print_r(Input::get('details'));die;
        if (Input::get('details') !== null) {
            foreach (Input::get('details') as $key => $detail) {
                foreach ($detail as $k => $row) {
                    if ($row['action'] == 'insert') {
                        unset($row['action']);
                        $add_fields = $this->detail[$key]['forign_key'] . "," . $this->detail[$key]['add_fields'];
                        $VALUES = '';
                        foreach ($row as &$val)
                            $val = "'" . $val . "'";
                        $VALUES = implode(',', array_slice($row, 0, sizeof(explode(",", $this->detail[$key]['add_fields']))));
                        $VALUES = "'" . (($this->id !== null) ? $this->id : Input::get('id')) . "'," . $VALUES;
                        DB::insert("INSERT INTO `" . $this->detail[$key]['table'] . "`"
                                . "(" . $add_fields . ")"
                                . "VALUES($VALUES)");
                    } else if ($row['action'] == 'update') {
                        unset($row['action']);
                        $SET = '';
                        foreach ($this->detail[$key]['edit_fileds'] as $h => $val)
                            $SET.="`" . $val . "`='" . $row[$h] . "',";
                        $SET = rtrim($SET, ",");
                        $VALUES = implode(',', $row);
                        DB::insert("UPDATE `" . $this->detail[$key]['table'] . "`"
                                . "SET $SET"
                                . " WHERE `id` = '{$row['id']}'");
                    } else if ($row['action'] == 'delete') {
                        DB::table($this->detail[$key]['table'])->where('id', '=', $row['id'])->delete();
                    }
                }
            }
        }
    }

    public function detect($serv_id, $action, $extra = '', $json_decode = TRUE) {
        $manager = new Http\Controllers\manager();
        return $manager->detect($serv_id, $action, $extra, $json_decode);
    }

}

/*
 *                             
                            case 'edit':
                            $t = $this::find($row['id']);
                            unset($row['action']);
                            unset($row['id']);
                            $i = 0;
                            foreach ($this->detail[$key]['edit_fields'] as $fields)
                                $t->$fields = $row[$i++];
                            $t->save();
                            break;
 * 
 * 
 * 
 */