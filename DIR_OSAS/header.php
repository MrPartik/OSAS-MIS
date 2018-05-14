
<?php 
session_start();
include('../config/dashboard/count.php'); 
include('../config/query.php');
if($_SESSION['logged_user']['role']=="Organization")
    { }
    else if($_SESSION['logged_user']['role']=="Administrator")
    { header("location:../DIR_ADMIN/dashboard.php"); }
    else if($_SESSION['logged_user']['role']=="Student")
    { }
    else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
    { header("location:../");}
$user_check = $_SESSION['logged_user']['username']; 
$referenced_user = $_SESSION['logged_user']['ref']; ?>
    <!DOCTYPE html>
<head> 
        <link rel="shortcut icon" href="../images/favicon.png"> 
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

    <link rel="stylesheet" href="../ASSETS/js/data-tables/DT_bootstrap.css" />
        

</head> 
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="dashboard.php" class="logo"> <img src="../images/logo.png" alt=""> </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div> 
             
            <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- notification dropdown start-->
                    <?php include('../config/Notification.php'); ?>
                    <!-- notification dropdown end -->
                </ul>
            <!--  notification end -->
            </div>
            <div class="top-nav clearfix"> 
            
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">  
                    <li>
                        <input type="text" class="form-control search" name="search" placeholder="Search" autocomplete="off" > </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src="../images/OSAS/MAAM%20DEM.jpg">
                             <span class="username" code='<?php echo $referenced_user  ?>'><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
                        <ul class="dropdown-menu extended logout">
                            <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li> -->
                            <li ><a href="#Change" data-toggle="modal"><i class="fa fa-key"></i> Change Password</a></li>
                            <li><a href="../config/logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
                <ul class="nav top-menu">
             <li>
                    <?php echo $breadcrumbs ?>
            </li>
            </ul>
            </div>
        </header>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Change" class="modal fade">
        <div class="modal-dialog" style="width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body"> 
                        <div class="row">
                            <div class="col-md-12">Current Password<input id="address" type="text" class="form-control" placeholder="enter your home/ permanent address"> </div>
                            <div class="col-md-12" style="padding-top:10px">Verify Password<input id="address" type="text" class="form-control" placeholder="enter your home/ permanent address"> </div>
                            <div class="col-md-12" style="padding-top:10px">New Password<input id="address" type="text" class="form-control" placeholder="enter your home/ permanent address"> </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button> 
                        <button name="insert" class="btnInsert btn btn-success" type="submit">Update Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div><?php  include('../config/NotificationApproval.php') ?>
        <!--header end-->
