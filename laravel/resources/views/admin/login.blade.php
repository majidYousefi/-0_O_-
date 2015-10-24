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
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <center>
        <?php
  //  echo  Form::open(['action'=>'userController@identify']);
        ?>
        <form method="post" action="userLogin" >
        <table>
            <tr>
                <td>
                    <input autocomplete="off" class="form-control" placeholder="username..." type="text" name="username" id="username">  
                </td>
            </tr>
             <tr>
                <td>
                      <input  class="form-control" placeholder="password..." type="password" name="password" id="password"> <br> 
                </td>
            </tr>
             <tr>
                <td>
                     <button class="btn btn-success" type="submit">login</button>
                </td>
            </tr>
        </table>
          <input name="_token" type="hidden" value="{{ csrf_token() }}">
        </form>
 </center>
    <?PHP
       // echo '<hr> user: '.Session::get('user');
    
    ?>
    </body>
</html>
