<!DOCTYPE html>
<title>OSAS - Dashboard</title>
<?php 
$currentPage ='OSAS_Dashboard';
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt' style='position'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='dashboard.php' class='current'>Dashboard</a> </li>
</ul>
</div>";
include('header.php'); 
include('../config/connection.php');     
     if($_SESSION['logged_user']['role']=="Organization")
    { }
    else if($_SESSION['logged_user']['role']=="Administrator")
    { header("location:../admin_dir/dashboard.php"); }
    else if($_SESSION['logged_user']['role']=="Student")
    { }  
    else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
    { header("location:../");}
?>

    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <!-- <div class="col-md-12">
                            <ul class="breadcrumbs-alt" style="position">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a href="dashboard.php" class="current">Dashboard</a> </li>
                            </ul>
                        </div> -->
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-user"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud; ?></span> Number of Students </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-users"></i></span>
                                <div class="mini-stat-info"> <span>450</span> Registered Organization </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
                                <div class="mini-stat-info"> <span>5</span> Organization Fund Request </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-asterisk"></i></span>
                                <div class="mini-stat-info"> <span>10</span> Number of Student who lost their Regicard or ID </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-user"></i></span>
                                <div class="mini-stat-info"> <span> <?php echo $count_stud_sanction?></span> Number of Students who has sanction/s </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-users"></i></span>
                                <div class="mini-stat-info"> <span>20</span> Organization/s who is peding for accreditation </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-envelope"></i></span>
                                <div class="mini-stat-info"> <span>100</span> Number of Archived Documents </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa fa-paperclip"></i></span>
                                <div class="mini-stat-info"> <span>0</span>Number of Student who has financial assistance</div>
                            </div>
                        </div>
                       
                    </div>
                </section>
            </section>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>
    </body>