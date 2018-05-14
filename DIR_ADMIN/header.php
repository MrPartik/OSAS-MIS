<?php 
session_start();
include('../config/dashboard/count.php'); 
include('../config/query.php');
    if($_SESSION['logged_user']['role']=="OSAS HEAD")
    { header("location:../DIR_OSAS/dashboard.php"); }
else if($_SESSION['logged_user']['role']=="Organization")
{ }
else if($_SESSION['logged_user']['role']=="Student")
{ }
else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
{ header("location:../");}
$user_check = $_SESSION['logged_user']['username'];
$referenced_user = $_SESSION['logged_user']['ref']; ?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="../ASSETS/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/select2/select2.css" />
    <link href="../ASSETS/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ASSETS/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="../ASSETS/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../ASSETS/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../ASSETS/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="../ASSETS/css/clndr.css" rel="stylesheet">
    <link href="../ASSETS/js/css3clock/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../ASSETS/js/morris-chart/morris.css">
    <link href="../ASSETS/css/style.css" rel="stylesheet">
    <link href="../ASSETS/css/style-responsive.css" rel="stylesheet" />
    <link href="../ASSETS/js/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-datepicker/css/datepicker.css" />

    <link href="../ASSETS/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../ASSETS/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../ASSETS/js/data-tables/DT_bootstrap.css" />
</head>


<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="dashboard.php" class="logo"> <img src="../ASSETS/images/logo.png" alt=""> </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->

            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder=" Search"> </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src='../Avatar/<?php echo $user_check; ?>.png'>
                            <span class="username" code='<?php echo $referenced_user  ?>'><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="../config/logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <ul class="nav top-menu">
                <li>
                    <?php echo $breadcrumbs; ?>
                </li>
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
