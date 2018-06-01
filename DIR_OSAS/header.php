<?php
session_start();
include('../config/dashboard/count.php'); 
include('../config/query.php');
if($_SESSION['logged_user']['role']=="Student Assistant" || $_SESSION['logged_user']['role']=="Staff" )
    {}else
    {
         if($_SESSION['logged_user']['role']=="Student Assistant")
        { header("location:../DIR_OSAS/dashboard.php"); }
        else if($_SESSION['logged_user']['role']=="Staff")
        { header("location:../DIR_OSAS/dashboard.php"); }
    }
     if($_SESSION['logged_user']['role']=="Organization")
    { }
     if($_SESSION['logged_user']['role']=="Administrator")
    { header("location:../DIR_ADMIN/dashboard.php"); }
     if($_SESSION['logged_user']['role']=="Student")
    { }
     if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
    { header("location:../");}

$user_check = $_SESSION['logged_user']['username']; 
$referenced_user = $_SESSION['logged_user']['ref']; ?>
    <!DOCTYPE html>

    <head>
        <link rel="shortcut icon" href="../ASSETS/images/favicon.png">
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
        <link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="../ASSETS/js/select2/select2.css" />
        <link rel="stylesheet" href="../ASSETS/js/data-tables/DT_bootstrap.css" />
        <!--icheck-->
        <link href="../ASSETS/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/minimal/red.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/minimal/green.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/minimal/blue.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/minimal/yellow.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/minimal/purple.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/green.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/blue.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/yellow.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/square/purple.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/grey.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/red.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/blue.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/yellow.css" rel="stylesheet">
        <link href="../ASSETS/js/iCheck/skins/flat/purple.css" rel="stylesheet"> </head>
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
                        <input type="text" class="form-control search" name="search" placeholder="Search" autocomplete="off"> </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">  <img alt="" src='../Avatar/<?php echo  $user_check; ?>.png'><span class="username" code='<?php echo $referenced_user  ?>'><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
                        <ul class="dropdown-menu extended logout">
                            <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li> -->
                            <li><a href="#Change" data-toggle="modal"><i class="fa fa-key"></i> Change Profile</a></li>
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
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Change Profile</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-lg-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail"> <img src='../Avatar/<?php echo  $user_check; ?>.png' alt="" /> </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px;min-width: 300px; min-height: 250px; line-height: 20px;"></div>
                                        <div> <span class="btn btn-white btn-file">

                                                   <span class="fileupload-new"><i class="fa fa-paper-clip" ></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" id="OSAS_ProfilePicture" class="default" /> </span> <a href="#" class="btn btn-danger btn-sm fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12" style="padding-top:10px">Username
                                    <input id="OSAS_username" type="text" class="form-control" placeholder="your username" value="<?php echo $user_check; ?>"> </div>
                                <div class="col-md-12" style="padding-top:10px">Current Password
                                    <input id="OSAS_currentpassword" type="password" class="form-control" placeholder="your previous password"> </div>
                                <div class="col-md-12" style="padding-top:10px">New Password
                                    <input id="OSAS_newpassword" type="password" class="form-control" placeholder="your new password"> </div>
                                <div class="col-md-12" style="padding-top:10px" id="divVerify">Verify Password
                                    <input id="OSAS_verifypassword" type="password" class="form-control" placeholder="enter again your new password"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                        <button name="insertUpdateProfileInfo" class="btnInsert btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  include('../config/NotificationApproval.php') ?>
        <!--header end-->
