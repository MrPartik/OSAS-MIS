<!DOCTYPE html>
<html>
<head>
    <title>Admin - Dashboard</title>
    <?php 
$currentPage ='Admin_Dashboard'; 
include('header.php');  
include('../config/connection.php');
      
if($_SESSION['logged_user']['role']=="OSAS HEAD")
{ header("location:../osas_dir/dashboard.php"); }
else if($_SESSION['logged_user']['role']=="Organization")
{ } 
else if($_SESSION['logged_user']['role']=="Student")
{ }
else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
{ header("location:../");}
?>
</head>

<body>
    <!--header start-->
     
    <?php
 
            $view_query = mysqli_query($con,"SELECT (SELECT COUNT(*) FROM `r_batch_details` WHERE Batch_DISPLAY_STAT = 'Active') AS BATCH, (SELECT COUNT(*) FROM `r_clearance_signatories` WHERE ClearSignatories_DISPLAY_STAT = 'Active') AS SIGNATORY, (SELECT COUNT(*) FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active') AS COURSE, (SELECT COUNT(*) FROM `r_designated_offices_details` WHERE DesOffDetails_DISPLAY_STAT = 'Active') AS OFFICE,(SELECT COUNT(*) FROM `r_financial_assistance_title` WHERE FinAssiTitle_DISPLAY_STAT = 'Active') AS TITLE,(SELECT COUNT(*) FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active') AS ACCDET,(SELECT COUNT(*) FROM `r_sanction_details` WHERE SancDetails_DISPLAY_STAT = 'Active') AS SANCDET,(SELECT COUNT(*) FROM `r_org_category` WHERE OrgCat_DISPLAY_STAT = 'Active') AS CAT,(SELECT COUNT(*) FROM `r_semester` WHERE Semestral_DISPLAY_STAT = 'Active') AS SEM");
            while($row = mysqli_fetch_assoc($view_query))
            {
                $batch = $row["BATCH"];
                $signatory = $row["SIGNATORY"];
                $course = $row["COURSE"];										
                $office = $row["OFFICE"];										
                $title = $row["TITLE"];										
                $accdet = $row["ACCDET"];										
                $sancdet = $row["SANCDET"];										
                $cat = $row["CAT"];	
                $sem = $row["SEM"];										


                
            }			

        ?>
        <!--header end-->
        <section id="container">
             <?php include("sidenav.php")?>
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->
                    <div class="row" style="float:right;">
                        <div class="col-md-12  ">
                            <!--breadcrumbs start -->
                            <ul class="breadcrumbs-alt ">
                                <li>
                                    <a class="current" href="#">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#">Home </a>
                                </li>
                                <!-- <li> -->
                                <!-- <a class="active-trail active" href="#">Pages</a> -->
                                <!-- </li> -->

                            </ul>
                            <!--breadcrumbs end -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <section class="panel text-center">
                                                <div class="pricing-table">
                                                    <div class="pricing-head" style="background-color:#81B9C3;">
                                                        <h3 style="padding-top:50px;color:white">System Setup</h3>
                                                        <h5 style="color:white">Quick Review</h5>
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon " style="background-color:#A38F84"><i class="fa lg fa-gavel"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $accdet; ?></span> Accreditation Requirement
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#5C9DED"><i class="fa fa-asterisk"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $title; ?></span> Assistance Title
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#D870AD"><i class="fa  fa-thumb-tack"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $course ; ?></span> Course
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#75706B"><i class="fa fa-anchor"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $signatory; ?></span> Clearance Signatory
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon " style="background-color:#D14841"><i class="fa fa-home"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $office; ?></span> Designated Offices
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#61BD6D"><i class="fa fa-asterisk"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $cat; ?></span> Organization Category
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#3D8EB9"><i class="fa fa-tasks"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $sancdet; ?></span> Sanction
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mini-stat clearfix" style="background-color:#F1F2F7">
                                                                    <span class="mini-stat-icon" style="background-color:#553982"><i class="fa  fa-calendar-o"></i></span>
                                                                    <div class="mini-stat-info">
                                                                        <span><?php echo $sem; ?></span> Semester
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </section>
                                        </div>
                                        <div class="col-lg-6">
                                            <section class="panel text-center">
                                                <div class="pricing-table">
                                                    <div class="pricing-head" style="background-color:#D0695A;">
                                                        <h1>
                                                        </h1>
                                                    </div>
                                                    <div class="pricing-quote">
                                                        1
                                                        <p>Account</p>
                                                    </div>
                                                    <div style="background-color:#F1F2F7;">
                                                        <h1 style="padding-top:80px;padding-bottom:20px"> Current User </h1>
                                                    </div>
                                                    <section class="panel weather-box" style="padding-top:15px">
                                                        <div class="symbol purple-bg">
                                                            <i class="fa fa-user "></i>
                                                        </div>
                                                        <div class="value" style="background-color:#F1F2F7;padding-top:70px">
                                                            <i class="fa fa-smile-o"></i>
                                                            <h4>6</h4>
                                                            <p>Active Accounts</p>
                                                        </div>
                                                    </section>
                                                    <div class="col-lg-4">
                                                        <div class="mini-stat clearfix" style="background-color:#F1F2F7;">
                                                            <span class="mini-stat-icon" style="background-color:#61BD6D"><i class="fa  fa-star"></i></span>
                                                            <div class="mini-stat-info">
                                                                <span>1</span> OSAS Head<br/>Account
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mini-stat clearfix" style="background-color:#F1F2F7;">
                                                            <span class="mini-stat-icon" style="background-color:#5C9DED"><i class="fa fa-wrench"></i></span>
                                                            <div class="mini-stat-info">
                                                                <span>5</span> System Admin<br/>Account
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mini-stat clearfix" style="background-color:#F1F2F7;">
                                                            <span class="mini-stat-icon" style="background-color:#D14841"><i class="fa fa-users"></i></span>
                                                            <div class="mini-stat-info">
                                                                <span>0</span> Organization<br/>Account
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
            <!--main content end-->
            <!--right sidebar start-->
            <div class="right-sidebar">
                <div class="right-stat-bar">
                    <ul class="right-side-accordion">
                        <li class="widget-collapsible">
                            <ul class="widget-container">
                                <li>
                                    <div class="prog-row side-mini-stat clearfix">

                                        <div class="side-mini-graph">
                                            <div class="target-sell">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!--right sidebar end-->

        </section>

        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="../../js/jquery-1.8.3.min.js"></script>
        <script src="../../bs3/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../../js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../../js/jquery.scrollTo.min.js"></script>
        <script src="../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="../../js/jquery.nicescroll.js"></script>
        <!--Easy Pie Chart-->
        <script src="../../js/easypiechart/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <script src="../../js/sparkline/jquery.sparkline.js"></script>
        <!--jQuery Flot Chart-->
        <script src="../../js/flot-chart/jquery.flot.js"></script>
        <script src="../../js/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="../../js/flot-chart/jquery.flot.resize.js"></script>
        <script src="../../js/flot-chart/jquery.flot.pie.resize.js"></script>

        <script type="text/javascript" src="../../js/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="sweetalert/sweetalert.min.js"></script>

        <!--common script init for all pages-->
        <script src="../../js/scripts.js"></script>

</body>

</html>
