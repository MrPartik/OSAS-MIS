<!DOCTYPE html>
<html>
<title>OSAS - Application and Compliance</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Accreditation</a></li> </ul></div>";
$currentPage ='OSAS_OrgApplication';
include('../config/connection.php');
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

?>

    <head>
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
        <link href="../ASSETS/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
        <link href="../ASSETS/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="../ASSETS/js/data-tables/DT_bootstrap.css" />

        <!-- Custom styles for this template -->
        <link href="../ASSETS/css/style.css" rel="stylesheet">
        <link href="../ASSETS/css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../ASSETS/js/select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="../ASSETS/js/jquery-multi-select/css/multi-select.css" />

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
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src="../ASSETS/images/OSAS/MAAM%20DEM.jpg"> <span class="username"><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="../config/logout.php"><i class="fa fa-key"></i> Log Out</a></li>
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
        <style>
            body {
                margin-top: 30px;
            }

            .stepwizard-step p {
                margin-top: 0px;
                color: #666;
            }

            .stepwizard-row {
                display: table-row;
            }

            .stepwizard {
                display: table;
                width: 100%;
                position: relative;
            }

            .stepwizard-step button[disabled] {
                /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
            }

            .stepwizard .btn.disabled,
            .stepwizard .btn[disabled],
            .stepwizard fieldset[disabled] .btn {
                opacity: 1 !important;
                color: #bbb;
            }

            .stepwizard-row:before {
                top: 14px;
                bottom: 0;
                position: absolute;
                content: " ";
                width: 100%;
                height: 1px;
                background-color: #ccc;
                z-index: 0;
            }

            .stepwizard-step {
                display: table-cell;
                text-align: center;
                position: relative;
            }

            .btn-circle {
                width: 30px;
                height: 30px;
                text-align: center;
                padding: 6px 0;
                font-size: 12px;
                line-height: 1.428571429;
                border-radius: 15px;
            }

        </style>
    </section>

    <body>

        <section id="container">
            <!--header end-->
            <aside>
                <div id="sidebar" class="nav-collapse">
                    <!-- sidebar menu start-->
                    <?php

                include('sidenav.php')

                ?>
                        <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row" id="tableForm">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Organization Management <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">
                                        Application <i class="fa fa-plus"></i>
                                    </button>
                                            </div>
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">Renew organization <i class="fa fa-plus"></i>
                                    </button>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="#">Print</a></li>
                                                    <li><a href="#">Save as PDF</a></li>
                                                    <li><a href="#">Export to Excel</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="space15"></div>
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Application Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th style="width:100px">Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php


                                        $view_query = mysqli_query($con," SELECT OrgAppProfile_APPL_CODE,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION, (SELECT IFNULL((SELECT WIZARD_CURRENT_STEP FROM r_application_wizard WHERE WIZARD_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE )),'1') ) AS STEP, (SELECT COUNT(*) FROM r_org_accreditation_details WHERE OrgAccrDetail_DISPLAY_STAT = 'Active') AS A1, (SELECT COUNT(*) FROM t_org_accreditation_process WHERE OrgAccrProcess_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE) AND OrgAccrProcess_DISPLAY_STAT = 'Active' ) as A2 ,
(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process WHERE OrgAccrProcess_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE) AND OrgAccrProcess_IS_ACCREDITED = 1 ) = (SELECT COUNT(*) FROM r_org_accreditation_details WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE' ) ) AS TR


FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active' ");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["OrgAppProfile_APPL_CODE"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $desc = $row["OrgAppProfile_DESCRIPTION"];
                                            $accstat = $row["TR"];
                                            $step = $row["STEP"];
                                            $curstep = '';
                                            if($step == 1)
                                                $curstep = '<span class="label label-primary">Newly Applicant</span>';
                                            else if($step == 2)
                                                $curstep = '<span class="label label-info">Setting Organization Category</span>';
                                            else if($step == 3)
                                                $curstep = '<span class="label label-warning">Setting Adviser</span>';
                                            else if($step == 4)
                                                $curstep = '<span class="label label-default">Setting Mission and Vision</span>';
                                            else if($step == 5)
                                            {
                                                if($accstat == 'TRUE' )
                                                    $curstep = '<span class="label label-success">Accredited</span>';
                                                else
                                                    $curstep = '<span class="label " style="background-color:#41CAC0">Completing Accreditation</span>';
                                            }

                                            echo "
                                            <tr class=''>
                                                <td>$code</td>
                                                <td>$name</td>
                                                <td>$desc</td>
                                                <td><center style='padding-top:10px'>$curstep</center></td>
                                                <td style='width:200px'>
                                                    <center>
                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>
                                                         <a class='btn btn-info wizardOpen' href='javascript:;'><i class='fa fa-flag'></i></a>
                                                        <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                        }



									?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Application Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th style="width:100px">Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row" id="wizardForm">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    <lbl id="lblname">Form Wizard</lbl>
                                    <span class=" pull-right">
                                    <a id="closewizardForm" class="fa fa-times"></a>
                                 </span>
                                </header>
                                <div class="panel-body">


                                    <div class="stepwizard" id="asteps">

                                        <div class="stepwizard-row setup-panel">
                                            <center>
                                                <div class="stepwizard-step col-xs-2">
                                                    <a href="#step-1" id="aStep1" type="button" class="btn btn-success btn-circle">1</a>
                                                    <p><small>Academic Year</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2">
                                                    <a href="#step-2" id="aStep2" type="button" class="btn btn-default btn-circle" disabled>2</a>
                                                    <p><small>Category</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2">
                                                    <a href="#step-3" id="aStep3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                    <p><small>Adviser</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2">
                                                    <a href="#step-4" id="aStep4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                                    <p><small>Mission & Vision</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2">
                                                    <a href="#step-5" id="aStep5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                                                    <p><small>Accreditation</small></p>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <form role="form">
                                        <div class="panel panel-primary setup-content" id="step-1">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">For what academic year? </h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="control-label">Academic Year</label>
                                                    <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpyear">
                                                        <?php

                                                            $view_query = mysqli_query($con,"SELECT Batch_YEAR AS YEAR FROM `r_batch_details` WHERE Batch_DISPLAY_STAT = 'Active' ORDER BY Batch_YEAR DESC ");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $year = $row["YEAR"];

                                                                echo "<option value='$year'>$year</option>";
                                                            }
                                                        ?>
                                                 </select>
                                                </div>
                                                <button class="btn btn-primary nextBtn pull-right" type="button" id="btnStep1">Next</button>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary setup-content" id="step-2">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What category the organization belong?</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-lg-6 form-group">
                                                    <label class="control-label">Organization Category</label>
                                                    <select class="form-control input-sm m-bot15 selectYear" id="drpcat">
                                                        <?php

                                                            $view_query = mysqli_query($con,"SELECT OrgCat_CODE AS CODE , OrgCat_NAME AS NAME FROM `r_org_category` WHERE OrgCat_DISPLAY_STAT = 'Active'");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $catcode = $row["CODE"];
                                                                $catname = $row["NAME"];

                                                                echo "
                                                                    <option value='$catcode'>$catname</option>
                                                                        ";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 form-group" id="course">

                                                    <label class="control-label">Course</label>
                                                    <select multiple name="e9" id="e9" style="width:100%" class="populate">
                                                        <?php
                                                            $view_query = mysqli_query($con,"SELECT Course_CODE as CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active'");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $coucode = $row["CODE"];

                                                                echo "
                                                                    <option value='$coucode'>$coucode</option>
                                                                        ";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button class="btn btn-primary nextBtn pull-right" id="btnStep2" type="button">Next</button>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary setup-content" id="step-3">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">Who is the Adviser?</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="control-label">Adviser Name</label>
                                                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Adviser Name" id="txtadvname" />
                                                </div>
                                                <button class="btn btn-primary nextBtn pull-right" type="button" id="btnStep3">Next</button>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary setup-content" id="step-4">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What do they Visualize?</h3>
                                            </div>
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Mission</label>
                                                        <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtmission" style="roverflow:auto;resize:none"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label">Vision</label>
                                                        <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtvision" style="roverflow:auto;resize:none"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary nextBtn pull-right" type="button" id="btnStep4">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary setup-content" id="step-5">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What requirement do they have?</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row" id="profile">
                                                    <form method="post" id="form-data4">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class='hidden'>code</th>
                                                                    <th>#</th>
                                                                    <th>Accreditation Name</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="updaccreqlist">
                                                                <?php

                                                        $view_query = mysqli_query($con,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
                                                        $i = 0;
                                                        while($row = mysqli_fetch_assoc($view_query))
                                                        {
                                                            $i++;
                                                            $desc = $row["des"];
                                                            $code = $row["code"];
                                                            echo "
                                                            <tr class=''>
                                                                <td>$i</td>
                                                                <td >$desc</td>
                                                                <td><input type='checkbox' id='chkupdstat$i' name='chkacc' class='checkbox form-control' style='width: 20px'></td>

                                                                <td id='updcode$i' class='hidden'>$code</td>
                                                            </tr>
                                                                    ";
                                                        } ?>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                                <button class="btn btn-success pull-right" type="button" id="btnFinish">Finish!</button>
                                                <h4 id="orgcode" style="display:none">asd</h4>

                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </section>
                        </div>
                    </div>


                    <a class='btn btn-cancel tar edit hidden' style='color:white' data-toggle='modal' id="openModalupd" href='#Edit' href='javascript:;'>Profile</a>
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
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Organization Profile</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="form-data">
                                    <div class="row" id="profile">
                                        <div class="col-lg-6 form-group">
                                            Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. COMMITS Pioneer" id="txtname">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                                        </div>
                                        <div class="col-lg-3 form-group hidethis">
                                            <input type="checkbox" id="chkacc" name="chkacc" class="checkbox form-control" style="width: 20px">
                                            <label for="chkacc">Accredited</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="close" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-success " id="submit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Student</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="form-data2">
                                    <div class="row" id="profile">
                                        <div class="col-lg-6 form-group">
                                            Organization Application Code <input name="studno" disabled type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" id="txtupdcode">
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdname">
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                                        </div>
                                        <div class="col-lg-3 form-group hidethis">
                                            <input type="checkbox" id="chkupdacc" name="chkupdacc" class="checkbox form-control" style="width: 20px">
                                            <label for="chkacc">Accredited</label>
                                        </div>
                                    </div>
                                    <input name="studno" type="text" class="form-control hidden" id="txtgetid">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="../ASSETS/js/jquery-1.8.3.min.js"></script>
        <script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
        <script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="../ASSETS/js/jquery.nicescroll.js"></script>
        <!--Easy Pie Chart-->
        <script src="../ASSETS/js/easypiechart/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <script src="../ASSETS/js/sparkline/jquery.sparkline.js"></script>
        <!--jQuery Flot Chart-->
        <script src="../ASSETS/js/flot-chart/jquery.flot.js"></script>
        <script src="../ASSETS/js/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="../ASSETS/js/flot-chart/jquery.flot.resize.js"></script>
        <script src="../ASSETS/js/flot-chart/jquery.flot.pie.resize.js"></script>

        <script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="../ASSETS/js/sweetalert/sweetalert.min.js"></script>
        <script src="../ASSETS/js/select2/select2.js"></script>
        <script src="../ASSETS/js/select-init.js"></script>

        <!--common script init for all pages-->
        <script src="../ASSETS/js/scripts.js"></script>

        <!--script for this page only-->
        <script src="Organization/OrganizationApplication.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>
            $(document).ready(function() {
                $('#wizardForm').hide();
                $('.hidethis').hide();


                wizardOpen = $('.wizardOpen');
                wizardOpen.click(function() {
                    $('#tableForm').slideToggle();
                    $('#wizardForm').slideToggle();

                });


                $('#closewizardForm').click(function() {
                    $('#tableForm').slideToggle();
                    $('#wizardForm').slideToggle();
                });


                var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn');

                allWells.hide();

                navListItems.click(function(e) {
                    e.preventDefault();
                    var $target = $($(this).attr('href')),
                        $item = $(this);

                    if (!$item.hasClass('disabled')) {
                        navListItems.removeClass('btn-success').addClass('btn-default');
                        $item.addClass('btn-success');
                        allWells.hide();
                        $target.show();
                        $target.find('input:eq(0)').focus();
                    }
                });

                allNextBtn.click(function() {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='url']"),
                        isValid = true;

                    $(".form-group").removeClass("has-error");
                    for (var i = 0; i < curInputs.length; i++) {
                        if (!curInputs[i].validity.valid) {
                            isValid = false;
                            $(curInputs[i]).closest(".form-group").addClass("has-error");
                        }
                    }

                    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                });

                $('div.setup-panel div a.btn-success').trigger('click');
            });
            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

    </body>

</html>
