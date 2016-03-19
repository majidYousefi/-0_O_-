<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class signController extends Controller {

    public function login() {
        $username = htmlentities(Input::get("username"));
        $password = htmlentities(Input::get("password"));
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            Session::put('allow_access', '1');
            
            $services=array();
            $result=DB::select(DB::raw("SELECT id,controller,model,view FROM services "));
            foreach($result as $res){
              $services[$res->id]['controller']=$res->controller;
              $services[$res->id]['model']=  $res->model;
              $services[$res->id]['view']=  $res->view;
            }
            
            Session::put('services',$services );
            return redirect("panel");
        }
        return redirect('sys_admin');
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect('sys_admin');
    }

    public function getServicesAndShowPanel() {
        $serv = DB::select(DB::raw("SELECT DISTINCT s.id,s.title,s.parent_id 
            FROM services s 
            JOIN user_group ug on(FIND_IN_SET(s.id,ug.services_id))
            JOIN users u on(FIND_IN_SET(ug.id,u.user_group_id))
            WHERE u.id=" . Auth::user()['attributes']['id']
        ));
        $sg=',';
        foreach($serv as  $s)
        {
            $sg.=$s->parent_id.',';
        }
        $serv_group = DB::select(DB::raw("SELECT id,title
            FROM service_group WHERE FIND_IN_SET(id,'".$sg."')"
        ));
        return view('admin.panel', ["services" => $serv,"serv_group"=>$serv_group]);
    }

}
