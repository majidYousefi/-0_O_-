<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    

                <link href="<?php echo url();?>jqueyui/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="<?php echo url();?>jqueyui/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
        <script src="<?php echo  url();?>jqueyui/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
  

        <style>
    .form-control{
                width: 300px;
                display: inline-block;
            }
        </style>
    </head>
    <body >

        <?PHP   
      //  echo $text;
  //      $t =str_replace('&','X@_P',$text);
        //$text =str_replace("|&"," ",$text);
       // echo "<br>";
     // //  echo $t;
        
        ?>
 
   
     


    
   
           <iframe id='ifr' style="border:0px; min-height: 600px; overflow:hidden;"  scrolling="no"  src="<?PHP  echo url('ckeditor/samples/textEditor.php');    ?>" width="100%" height="100%" ></iframe>
           
   
                     
    </body>
</html>
