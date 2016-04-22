<?php

namespace App\Http\Controllers\c_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\generalController;
use Input;
use Hash;
use App\library\element;

class user_controller extends generalController {

  /*  public function show() {
        return view("admin.v_user",[
            'multiSelect' => $this->ms("user_group", "title", "", ""),
            'combo'=>  $this->gd(3,1, false, false)
        ]);
    }
*/

    public function add() {
 
 /*   Mail::send('welcome', [], function($message)
    {   
     
      //  $message->from("ochiha.itachi.mahv@gmail.com");
        $message->to('majid_yousefipoor@yahoo.com', 'myName')->subject('Mail via aallouch.com');
      // dd($message);
        
    });
        */
        
        //$this->sendMail("Salam",'',"ochiha.itachi.mahv@gmail.com","test");
     //$this->runEvent("SomeEvent");
       
        $this->rules(['f1'=>"required",'f2'=>"required|same:f3",'f3'=>"required",'f4'=>"required"],$this->serv_id);
              $this->model_obj->add();

    }

    public function edit() {
        $this->rules(['f1'=>"required",'f2'=>"same:f3",'f4'=>"required"],$this->serv_id);      
                $this->model_obj->edit();
    }


}
