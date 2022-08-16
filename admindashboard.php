<?php
session_start();
include_once 'db_conn.php';
$user="SELECT * FROM register;";
$userresult=mysqli_query($conn,$user);
//order
$order="SELECT distinct ordertable.order_id from tbmainorder , toollist , register, ordertable 
where ordertable.order_id=tbmainorder.order_id
and toollist.tools_id=tbmainorder.tools_id and register.id=ordertable.id ;";
$orderresult=mysqli_query($conn,$order);
//feedback
$feed="SELECT * FROM feedback;";
$feedresult=mysqli_query($conn,$feed);
// tool rent count
$tool="SELECT  tbmainorder.tools_id from tbmainorder , toollist , register, ordertable 
where ordertable.order_id=tbmainorder.order_id
and toollist.tools_id=tbmainorder.tools_id and register.id=ordertable.id ;";
$toolresult=mysqli_query($conn,$tool);

//order cancelled
$ordercancel="SELECT distinct ordertable.* from tbmainorder , toollist , register, ordertable 
where ordertable.order_id=tbmainorder.order_id
and toollist.tools_id=tbmainorder.tools_id and register.id=ordertable.id and ordertable.status='0';";
$ordercancelresult=mysqli_query($conn,$ordercancel);

if ($_SESSION['count']) {
  $pageview= $_SESSION['count'];

}else{
    $_SESSION['count']=0;
    $pageview=0;

}
?>

<html>

<head>
    <title>DASHBOARD</title>
    <link href="css/adminmain.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script>
    

        $(function() {

            'use strict';

            var aside = $('.side-nav'),
                showAsideBtn = $('.show-side-btn'),
                contents = $('#contents'),
                _window = $(window)

            showAsideBtn.on("click", function() {
                $("#" + $(this).data('show')).toggleClass('show-side-nav');
                contents.toggleClass('margin');
            });

            if (_window.width() <= 767) {
                aside.addClass('show-side-nav');
            }

            _window.on('resize', function() {
                if ($(window).width() > 767) {
                    aside.removeClass('show-side-nav');
                }
            });

            // dropdown menu in the side nav
            var slideNavDropdown = $('.side-nav-dropdown');

            $('.side-nav .categories li').on('click', function() {

                var $this = $(this)

                $this.toggleClass('opend').siblings().removeClass('opend');

                if ($this.hasClass('opend')) {
                    $this.find('.side-nav-dropdown').slideToggle('fast');
                    $this.siblings().find('.side-nav-dropdown').slideUp('fast');
                } else {
                    $this.find('.side-nav-dropdown').slideUp('fast');
                }
            });

          
        });
    </script>
    <link rel="stylesheet" href="https://use.fontawsome.com/releases/v5.0.1/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<?php
include 'adminheader.php';
?>
        <div class="welcome">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <h2>Welcome to Dashboard</h2>
                            <p>Do What You Always Do.. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="statistics">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <i class="fa fa-users fa-fw bg-primary"></i>
                            <div class="info">
                                <h3><?php
                                echo mysqli_num_rows($userresult);
                                ?></h3> <span>Users</span>
                                <p>User register in the Rentools</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <i class="fa fa-calendar-check fa-fw danger"></i>
                            <div class="info">
                                <h3>
                                <?php
                                echo mysqli_num_rows($orderresult);
                                ?>
                                </h3> <span>Orders</span>
                                <p>Order placed by users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <i class="fa fa-envelope-open fa-fw success"></i>
                            <div class="info">
                            <h3>
                                <?php
                                echo mysqli_num_rows($feedresult);
                                ?>
                                </h3> <span>Feedbacks</span>
                                <p>Feedback details given  by Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="charts">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="chart-container" id="chart1">
                        <a href="adminusers.php"> <h3>USER MODULE</h3>
                            <!-- REGISTRATION --> </a>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container" id="chart2">
                        <a href="adminorder.php">  <h3>ORDER MODULE</h3></a>
                            <!-- ORDERS -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container" id="chart3">
                        <a href="admintools.php">  <h3>TOOL MODULE</h3></a>
                            <!-- TOOLS -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="chart-container" id="chart4">
                        <a href="adminfeedback.php">  <h3>FEEDBACK MODULE</h3></a>
                            <!-- FEEDBACK -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container" id="chart5">
                        <a href="adminstocks.php">     <h3>STOCK MODULE</h3></a>
                            <!-- FEEDBACK -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="admins">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <h3>Admins:</h3>
                            <div class="admin">
                                <div class="img">
                                    <img class="img-responsive" src="img/normal.jpg" alt="admin">
                                </div>
                                <div class="info">
                                    <h3>Amal Vs</h3>
                                    <p>Admin of Rentools.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box">
                            <h3>Moderators:</h3>
                            <div class="admin">
                                <div class="img">
                                    <img class="img-responsive" src="img/normal.jpg" alt="admin">
                                </div>
                                <div class="info">
                                    <h3>Amal vs</h3>
                                    <p>Moderator of Rentools.</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
        </section>
        <section class='statis text-center'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box bg-primary">
                            <i class="fa fa-eye"></i>
                            <h3><?php
                            echo  $pageview;
                            ?></h3>
                            <p class="lead">Page views</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box danger">
                            <i class="fa fa-users"></i>
                            <h3><?php
                                echo mysqli_num_rows($ordercancelresult);
                                ?></h3>
                            <p class="lead">User Canceled</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box warning">
                            <i class="fa fa-shopping-cart"></i>
                            <h3><?php
                                echo mysqli_num_rows($toolresult);
                                ?></h3>
                            <p class="lead">Tool rents</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box success">
                            <i class="fa fa-handshake"></i>
                            <h3>  <?php
                                echo mysqli_num_rows($orderresult);
                                ?></h3>
                            <p class="lead">Transactions</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     
    </section>

</body>

</html>