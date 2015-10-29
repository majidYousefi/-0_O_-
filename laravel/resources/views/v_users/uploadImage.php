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
        <script>
             
            
            
   function upload()
    {  
         var fd = new FormData($("#fileinfo")[0]);
            $.ajax({
                url: 'uploadVisualMedia'+'/'+$("#title").val(),
                type: 'POST',
                enctype: 'multipart/form-data',
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                 data: fd,
                success: function(data)
                {
                   filter('allPhotos');
                }
            });
         return false;
   }
   
            </script>
    </head>
    <body>
            <form  id="fileinfo" onsubmit='return upload()' style="display:inline;" >
            <table>

                <input   class="form-control"  type="text" id="title" placeholder="عنوان" required>
                  
                <input  class="form-control"  type="file" name="visualMedia" id="visualMedia"   accept="image/*" required> </input>
              
             
                 
         
                   
               <button class="btn btn-success" type="submit">آپلود <span class="glyphicon glyphicon-floppy-open"></span></button>
                  
                             </form>
    </body>
</html>
