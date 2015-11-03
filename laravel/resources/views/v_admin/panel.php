<!doctype html>
<html lang=''>
    <head>
        <meta charset='utf-8'>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="menus/dropDown/styles.css">   
        <link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/panel.css">
        <script src="menus/dropDown/script.js"></script>
        <script src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
        <link href="bootstrap-3.3.5/css/BootstrapDialog.min.css" rel="stylesheet" type="text/css" />
        <script src="bootstrap-3.3.5/js/BootstrapDialog.min.js"></script>
        <script src="js/functions.js"></script>
        <link rel="stylesheet" href="css/ajaxLoader.css" type="text/css">
        
        <script src="js/growl/javascripts/jquery.growl.js" type="text/javascript"></script>
        <link href="js/growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css" />
        <script>
            function csrf()
            {
                return "<?php echo csrf_token(); ?>";
            }
            
            
function a()
{
	
		$(document).ready(function() {
//  $.growl({ title: "Growl", message: "The kitten is awake!" });
 // $.growl.error({ message: "The kitten is attacking!" });
 // $.growl.notice({ message: "The kitten is cute!" });

});
	  
}
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


    <div class="rightPanel">
        <div id='cssmenu' style="float: right;
             width: 100%;">
            <ul>
                <li class=' has-sub'><a href='#' >کالا</a>
                    <ul>
                        <li ><a href='#' class="fill"  name="newPost^fa" >Product 1</a>     </li>
                        <li ><a href='#' >Product 2</a>         </li>
                    </ul>
                </li>

                <li class=' has-sub'><a href='#'>سرویس</a>
                    <ul>
                        <li ><a href='#'>گروه کاربری</a>     </li>
                        <li ><a href='#' class="fill" name="getView^v_users.NewUser">کاربر</a>         </li>
                        <li ><a href='#'>سرویس</a>         </li>
                    </ul>
                </li>
                <li><a href='#'>About</a></li>
                <li><a href='#'>Contact</a></li>
            </ul>
        </div>
    </div>

    <!--********* MAIN DIV ********** -->
    <div id="mainPanel">  </div>
  <div id="growls" class="default"></div>
</body>



</html>
