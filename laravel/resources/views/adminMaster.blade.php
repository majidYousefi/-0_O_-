<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
       <META Http-Equiv="Cache-Control" Content="no-cache"/>
<META Http-Equiv="Pragma" Content="no-cache"/>
<META Http-Equiv="Expires" Content="0"/>
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  
  
        <style>
           
                @font-face {
                font-family: 'B Koodak';
                src: url("<?PHP echo url('fonts/BKoodkBd.ttf'); ?>");
            }
            @font-face {
                font-family: 'roya';
                src: url("<?PHP echo url('fonts/roya.ttf'); ?>");
            }    

            @font-face
            {
                font-family: 'BYekan';
                src: url("<?PHP echo url('fonts/BYekan.ttf'); ?>");
                src: url("<?PHP echo url('fonts/BYekan.woff'); ?>") format('woff');
                src: url("<?PHP echo url('fonts/BYekan.eot?#'); ?>")format('eot');
            }

      body
            {
                background-color: silver;
             font-family:BYekan,roya,'B Koodak';
            }

            table
            {
             width:100%;
             //height:100%;
                
            }
        </style>
        <title></title>
    </head>
    <body>
      
       @yield('body')     
       <table border="1">
           @yield('table')
           <tr>
               <td width="200">
               <a href="{{ URL::to('exit') }}">Logout</a>
               </td>
               <td >Profile</td>
           </tr>
             <tr>
                 <td width="200" style="vertical-align: baseline;">
                     @yield('rightPanleMenu')
                 </td>
               <td >
                   @yield('main')
               </td>
           </tr>
       </table>
    </body>
</html>
