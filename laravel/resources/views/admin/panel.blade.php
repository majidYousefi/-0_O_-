<!doctype html>
<html lang=''>
    <head>
        <meta charset='utf-8'>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="portal/js/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="portal/plugins/menus/dropDown/styles.css">   
        <link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
        <script src="portal/plugins/menus/dropDown/script.js"></script>
        <script src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
        <link href="bootstrap-3.3.5/css/BootstrapDialog.min.css" rel="stylesheet" type="text/css" />
        <script src="bootstrap-3.3.5/js/BootstrapDialog.min.js"></script>
        <script src="portal/js/functions.js"></script>
        <link rel="stylesheet" href="portal/css/ajaxLoader.css" type="text/css">
        <script src="portal/plugins/growl/javascripts/jquery.growl.js" type="text/javascript"></script>
        <link href="portal/plugins/growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css" />
        <!--<script src="portal/autocomplete/jquery.easy-autocomplete.min.js"></script> 
        <link rel="portal/autocomplete/stylesheet" href="easy-autocomplete.min.css"> -->
        <script src="portal/plugins/Datepicker-persianDatepicker/js/persianDatePicker.js"></script> 
        <link rel="stylesheet" href="portal/plugins/Datepicker-persianDatepicker/css/persianDatePicker-latoja.css"> 
        <script src="portal/plugins/ckeditor/ckeditor.js"></script>
        <link rel="portal/plugins/ckeditor/samples/css/samples.css">
        <link rel="stylesheet" href="portal/css/panel.css">
        <script src="portal/js/services/1_sevice_function.js"></script>
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


            setInterval(function () {
                // Create a newDate() object and extract the seconds of the current time on the visitor's
                var seconds = new Date().getSeconds();
                // Add a leading zero to seconds value
                $("#sec").html((seconds < 10 ? "0" : "") + seconds);
            }, 1000);

            setInterval(function () {
                // Create a newDate() object and extract the minutes of the current time on the visitor's
                var minutes = new Date().getMinutes();
                // Add a leading zero to the minutes value
                $("#min").html((minutes < 10 ? "0" : "") + minutes);
            }, 1000);

            setInterval(function () {
                // Create a newDate() object and extract the hours of the current time on the visitor's
                var hours = new Date().getHours();
                // Add a leading zero to the hours value
                $("#hours").html((hours < 10 ? "0" : "") + hours);
            }, 1000);



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
                   
                    <?PHP
                    foreach ($serv_group as $group) {
                        if ($group->top_menu == '1') {
                            echo " <li class='dropdown'>"
                            . "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>$group->title <span class='caret'></span></a>"
                                    . "<ul class='dropdown-menu'>";
                            foreach ($services as $serv) {
                                if ($serv->parent_id == $group->id)
                                    echo "<li><a href='#' class='fill' name=$serv->id>$serv->title</a>     </li>";
                            }
                            echo '</ul></li>';
                        }
                    }
                    ?>
                  <!--  <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Page 1 <span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                            <li><a href=#>Page 1-1</a></li>
                            <li><a href=#>Page 1-2</a></li>
                            <li><a href=#>Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href=#>Page 2</a></li>
                    <li><a href=#>Page 3</a></li>
                  -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> پروفایل من</a></li>
                    <li><a href="userLogout"><span class="glyphicon glyphicon-log-in"></span> خروج</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="menuPanel">
        <ul class="nav nav-tabs" id="TabIndex"></ul>
    </div>

    <div class="rightPanel">
        <div class="clock">
            <div id="Date">{{ $date }}</div>
            <ul>
                <li id="hours"></li>
                <li id="point">:</li>
                <li id="min"></li>
                <li id="point">:</li>
                <li id="sec"></li>
            </ul>
        </div>
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
                foreach ($serv_group as $group) {
                    if ($group->top_menu != '1') {
                        echo " <li class=' has-sub'><a href='#'>$group->title</a><ul>";
                        foreach ($services as $serv) {
                            if ($serv->parent_id == $group->id)
                                echo "<li><a href='#' class='fill' name=$serv->id>$serv->title</a>     </li>";
                        }
                        echo '</ul></li>';
                    }
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
    <div class="container" style="   width: 86%;float:left;  overflow: auto;  padding: 0;height:200px;  " >
        <div class="tab-content"  id="TabPlace"></div>
    </div>


    <div id="growls" class="default"></div>



</body>


</html>
