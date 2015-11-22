<?php

namespace App\library;

use DB;

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
class element {

    //put your code here
    public $elements = '';

    public static function editor($router = '', $width = '', $height = '', $lang = '') {
        $editor = "<select onchange=fill('{$router}',this.value) class='form-control' style='  width: 100px;'>
                          <option value='0'>زبان</option>
                          <option value='fa'>فارسی</option>
                          <option value='en'>english</option>
                          </select>";
        $editor.=file_get_contents("ckeditor/samples/editor2.php");
        $editor.= "<script>";
        $editor.=(!empty($lang)) ? "CKEDITOR.config.language = '{$lang}';" : "";
        $editor.=(!empty($width)) ? "CKEDITOR.config.width = $width;" : "";
        $editor.=(!empty($height)) ? "CKEDITOR.config.height = $height;" : "";
        $editor.="</script>";
        return $editor;
    }

    public function input($y = '') {
        $this->elements = "<input type='text' value=1 name='123' >";
    }

    public static function autoComplete($model, $attribute, $name, $required = '') {
        $data = DB::table($model)->lists($attribute);
        $ac = "<script>
               var d=['" . implode("','", $data) . "']
               var options = {data: d,
	       list: {match: {enabled: true}}     };  ";
        $ac.='$("#' . $name . '").easyAutocomplete(options);</script>';
        $ac.="<input class='form-control' id='{$name}' name='{$name}' $required/>";
        return $ac;
    }

    public static function multiSelect($model, $attribute, $name, $required = '',$id='id') {
    
        $data = DB::table($model)->select('id','title')->get();
        $mt = "<div class='multiSelect' id='{$name}'  title='{$required}'>";
        foreach($data as $row)
        {
            $mt.="<input type='checkbox'  value='{$row->id}' >".$row->$attribute."<br>" ;
       }
            $mt.="</div>";
        return $mt;
    }

}
