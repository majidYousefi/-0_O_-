<?php

namespace App\Http\Controllers;

use App\Http\Controllers\c_admin as c;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App;

define("SPACE", "App\Http\Controllers\c_admin\\");

class manager extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detect($serv_id, $action) {
        $services = [
            0 => ['post_controller', 'Post'],
            1 => ['user_controller', 'User'],
            2 => ['user_group_controller', 'UserGroup'],
            3 => ['services_controller', 'Services']
        ];

        $className = SPACE . $services[$serv_id][0];
        $do = new $className($services[$serv_id][1]);
        switch ($action) {
            case 's':
                return $do->show();
                break;
            case 'a':
                return $do->add();
                break;
            case 'e':
                return $do->edit();
                break;
            case 'g':
                return $do->get();
                break;
            case 'l':
                return $do->listx();
                break;
            case 'd':
                return $do->delete();
                break;
        }
    }

}
