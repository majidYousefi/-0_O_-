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
class editor {
    //put your code here
    
    public static function get($width = '', $height = '', $lang = '') {
        $cor = "<script>";
        $cor.=(!empty($lang)) ? "CKEDITOR.config.language = '{$lang}';" : "";
        $cor.=(!empty($width)) ? "CKEDITOR.config.width = $width;" : "";
        $cor.=(!empty($height)) ? "CKEDITOR.config.height = $height;" : "";
        $cor.="</script>";
        return file_get_contents("ckeditor/samples/editor.php") . $cor;
    }
}
