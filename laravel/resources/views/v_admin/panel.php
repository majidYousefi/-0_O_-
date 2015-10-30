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
        <script>
            function fill(func, extra_date)
            {

                $("#mainPanel").html('');
                $(document).ready(function (e) {
                    $.ajax({
                        url: func + "/" + extra_date,
                        beforeSend: function () {
                            //   ajaxtStart();
                        },
                        success: function (data) {
                            //    alert(data);
                            $("#mainPanel").html(data);
                            window.scrollBy(0, -1000);
                            //ajaxComplete();
                        }
                    });
                });
            }
            function sendFormAjax(func, ajForm)
            {
                var _token = "<?php echo csrf_token(); ?>";
                var data = {};
                data['_token'] = _token;
                $("#" + ajForm + " input").each(function () {
                    if (this.name!='')
                        data[this.name] = this.value;

                });

                $(document).ready(function (e) {
                    $.ajax({
                        url: func,
                        type: "post",
                        data,
                                success: function (data) {
                                    alert(data);
                                }
                    });
                    alert("zzz");
                });

            }
        </script>
    </head>
    <body>
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
                        <li class="active"><a href="#">Home</a></li>
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
                            <li ><a href='#' onclick="fill(this.id, 'fa')" id="newPost">Product 1</a>     </li>
                            <li ><a href='#'>Product 2</a>         </li>
                        </ul>
                    </li>

                    <li class=' has-sub'><a href='#'>Products</a>
                        <ul>
                            <li ><a href='#'>Product 1</a>     </li>
                            <li ><a href='#'>Product 2</a>         </li>
                        </ul>
                    </li>
                    <li><a href='#'>About</a></li>
                    <li><a href='#'>Contact</a></li>
                </ul>
            </div>
        </div>

        <!--********* MAIN DIV ********** -->
        <div id="mainPanel">
        </div>


    </body>



</html>
