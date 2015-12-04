<?php

namespace App\library;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of editor
 *
 * @author HP TMP253
 */
class dialog {

    //put your code here
    public $elements = '';
    public static $msg=[
        0=>"فیلد های اجباری را پر کنید .",
        1=>"X"
        
    ];

    public static function message($kind='def',$title='',$msg='')
    {
          return json_encode(["kind"=>"$kind","title"=>$title,"msg"=>"$msg"]);
    }
    

}





