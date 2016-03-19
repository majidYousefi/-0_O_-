<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use Input;
use Hash;
use App\library\element;
use Mail;
use App\Events\SomeEvent;
class user_controller extends generalController {

    public function show() {
        return view("admin.v_user",[
            'multiSelect' => $this->ms("user_group", "title", "", ""),
            'combo'=>  $this->gd(3,1, false, false)
        ]);
    }

    public function add() {
 
 /*   Mail::send('welcome', [], function($message)
    {   
     
      //  $message->from("ochiha.itachi.mahv@gmail.com");
        $message->to('majid_yousefipoor@yahoo.com', 'myName')->subject('Mail via aallouch.com');
      // dd($message);
        
    });
        */
        
        
     //  dd(event(new SomeEvent()));
        $this->rules(['f1'=>"required",'f2'=>"required",'f3'=>"required",'f4'=>"required"]);
                $this->model_obj->add();

      
       
    }

    public function edit() {
                 $this->rules(['f1'=>"required",'f4'=>"required"]);
                 if(!empty(Input::get("f2")) && Input::get("f2")!=Input::get("f3"))
                     $this->msg("تکرار رمز عبور اشتباست");
                         
                $this->model_obj->edit();

    }


}
