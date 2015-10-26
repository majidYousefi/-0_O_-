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
            function rem(id)
            {
             
            $.ajax({
                url:'removePhoto',
                data:{'id':id},
                type:'POST',
                success:function(data)
                {
                 filter('allPhotos');
                }
            });
            
    }
            
            </script>
    </head>
    <body>
        <?php
      foreach($photos as $photo)
      {
          echo '<div style="width:200px; height:200px; ">';
          echo "<img src=$photo->address width='200' height='200' />";
          echo "<button onclick=rem('".$photo->id."') >remove</button>";
          echo '</div>';
      }
        
        ?>
    </body>
</html>
