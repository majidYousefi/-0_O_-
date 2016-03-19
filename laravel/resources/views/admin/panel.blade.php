<!doctype html>
<html lang=''>
    <head>
        <meta charset='utf-8'>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="menus/dropDown/styles.css">   
        <link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
        <script src="menus/dropDown/script.js"></script>
        <script src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
        <link href="bootstrap-3.3.5/css/BootstrapDialog.min.css" rel="stylesheet" type="text/css" />
        <script src="bootstrap-3.3.5/js/BootstrapDialog.min.js"></script>
        <script src="js/functions.js"></script>
        <link rel="stylesheet" href="css/ajaxLoader.css" type="text/css">
        <script src="plugins/growl/javascripts/jquery.growl.js" type="text/javascript"></script>
        <link href="plugins/growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css" />
        <!--<script src="plugins/autocomplete/jquery.easy-autocomplete.min.js"></script> 
        <link rel="plugins/autocomplete/stylesheet" href="easy-autocomplete.min.css"> -->
        <script src="plugins/Datepicker-persianDatepicker/js/persianDatePicker.js"></script> 
        <link rel="stylesheet" href="plugins/Datepicker-persianDatepicker/css/persianDatePicker-latoja.css"> 
	<script src="ckeditor/ckeditor.js"></script>
	<link rel="ckeditor/samples/css/samples.css">
        <link rel="stylesheet" href="css/panel.css">
        <script>
            function csrf()
            {
                return "<?php echo csrf_token(); ?>";
            }
            $(document).ready(function () {
       $(".datePicker").persianDatepicker({
            theme: 'latoja',
            cellWidth: 42,
            cellHeight: 25});
        });
        </script>

    </head>
    <body>

    <center>
        <div class="spinner-loader"  id="ajaxLoader">
            Loading…
        </div>
    </center>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">خانه</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> پروفایل من</a></li>
                    <li><a href="userLogout"><span class="glyphicon glyphicon-log-in"></span> خروج</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="   width: 86%;float:left;  overflow: auto;  padding: 0;height:600px;" >

        <ul class="nav nav-tabs" id="TabIndex">
        </ul>

        <div class="tab-content"  id="TabPlace"></div>
    </div>

    <div class="rightPanel">
        <div id='cssmenu' style="float: right;
             width: 100%;">
        <ul>
           <!--         <li class=' has-sub'><a href='#' >کالا</a>
                    <ul>
                        <li ><a href='#' class="fill"  name="2" >Product 1</a>     </li>
                        <li ><a href='#' >Product 2</a>         </li>
                    </ul>
                </li>

                <li class=' has-sub'><a href='#'>سرویس</a>
                    <ul>
                        <li ><a href='#' class="fill" name="3">گروه کاربری</a>     </li>
                        <li ><a href='#' class="fill" name="1">کاربر</a>         </li>
                        <li ><a href='#' class="fill"  name="4" >سرویس ها</a>         </li>
                    </ul>
                </li>
      -->
                <?PHP 
                foreach($serv_group as $group)
                {
                    echo " <li class=' has-sub'><a href='#'>$group->title</a><ul>";
                        foreach ($services as $serv) {
                            if($serv->parent_id == $group->id)
                               echo "<li><a href='#' class='fill' name=$serv->id>$serv->title</a>     </li>";
                        }
                        echo '</ul></li>';
                }
                
                ?>
  <!--  
                <li class=' has-sub'><a href='#'>tt</a>
                    <ul>
                        <?PHP
                        foreach ($services as $serv) {
                            echo "<li><a href='#' class='fill' name=$serv->id>$serv->title</a>     </li>";
                        }
                        ?>
                    </ul>
                </li>

            <li><a href='#'>About</a></li>
                <li><a href='#'>Contact</a></li>
            
             -->
            </ul>
        </div>
    </div>

    <!--********* MAIN DIV ********** -->


    <div id="growls" class="default"></div>



</body>


</html>
