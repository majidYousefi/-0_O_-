<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
class signController extends Controller
{

    public function login() {
        $username = htmlentities(Input::get("username"));
        $password = htmlentities(Input::get("password"));
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
             return redirect("panel");
        }
        return redirect('sys_admin');
    }
    public function logout() {
        Auth::logout();
        return redirect('sys_admin');
    }
    
    public function getServicesAndShowPanel()
    {
        $serv= DB::select(DB::raw("SELECT DISTINCT s.id,s.title 
            FROM services s 
            JOIN user_group ug on(FIND_IN_SET(s.id,ug.services_id))
            JOIN users u on(FIND_IN_SET(ug.id,u.user_group_id))
            WHERE u.id=".Auth::user()['attributes']['id']
                
                ));

        return view('admin.panel',["services"=>$serv]);
    }


}
