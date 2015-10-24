
<!DOCTYPE html>
<!--
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
-->
<html>
<head>

	<title></title>
	<meta charset="utf-8">
	<script src="../ckeditor.js"></script>
	<link rel="stylesheet" href="sample.css">
      
        <script src="../../js/jquery.js"></script>

        <style>
            p
            {
                display:inline;
            }
        </style>

<script>
CKEDITOR.config.width=900;
CKEDITOR.config.height=320;
CKEDITOR.config.extraPlugins = 'bidi';
</script>

   <?PHP //if($_GET['text'] != '-1') {
         //   $t=str_replace('XOP','&',$_GET['text']);
         //    $text=htmlspecialchars_decode($t,ENT_QUOTES);
          //  echo "alert('six');";
           //echo
       //   echo "var t='".$text."'; ";
        //   echo " setTimeout('a(t)',1100)";
           // echo "a('".$text."')";
            
           
    //} 
            ?> 
<script>
 
                
                function a(text)
                {
                //    alert("aa");
                 $(document).ready(function() {
                   //  alert("aa");
		$(".cke_wysiwyg_frame").contents().find(".cke_editable").html(""+text.toString()+""); 
               // window.contents().find(".cke_wysiwyg_frame").contents().find(".cke_editable").append("<p>ss</p>");
            }); 
                }
    </script>
    <style>
        b
        {
            font-size: 22px;
        }
  
        select
        {
           // height:20px;
        //   width:100px;
 //height:25px;
 //border-radius:3px;
 //background: linear-gradient(rgba(171, 161, 161, 0),rgb(210, 212, 210));
        }
        input[type="text"][name="title"]:hover , select:hover
        {
          //  cursor: pointer;
        }
        
        h2{
            display:inline-block;
        }
            .form-control{
          //      width: 100px !important;
                display: inline-block;
            }
            .glyphicon
  {
  float:right;
  margin-left:25px;
  }
        </style>
</head>
<body dir="rtl">

    <?PHP
    session_start();
    ?>
    <form action="<?PHP echo  $_SESSION['url'].'/insertNewPost'; ?>" method="get" >

    <table>
    
           <tr><th colspan="3" style="min-heigth:800px;">
     
			<p>
                           
			<textarea dir="rtl" class="ckeditor" cols="180" id="editor2" name="text_body" rows="10">
	</textarea>
            </th></tr>
	
	
	       
			<tr><th colspan="3" >
                                <button  class="btn btn-success" type="submit" style="float:right;" >Save <span class="glyphicon glyphicon-floppy-saved"></span></button>

           </th></tr>
		


</table>
                      <input name="_token" type="hidden" value="iR6GrbUOE7jiVjvitLKUcD9pitpoRWDnph1NZIbD">
            	</form>

		
	
</body>


</html>
