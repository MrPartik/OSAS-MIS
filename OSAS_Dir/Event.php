<!DOCTYPE html>
<html>
<title>OSAS - Event</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Accreditation</a></li> </ul></div>";
$currentPage ='OSAS_Event';
include('../config/connection.php');
    session_start();
include('../config/dashboard/count.php'); 
include('../config/query.php');
if($_SESSION['logged_user']['role']=="Organization")
    { }
    else if($_SESSION['logged_user']['role']=="Administrator")
    { header("location:../admin_dir/dashboard.php"); }
    else if($_SESSION['logged_user']['role']=="Student")
    { }
    else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
    { header("location:../");}
$user_check = $_SESSION['logged_user']['username']; 

?>

    <head>
        <link href="../bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="../js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="../css/bootstrap-reset.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <link rel="stylesheet" href="../js/morris-chart/morris.css">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link href="../js/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
        <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../js/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="../js/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="../js/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />

        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../js/select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="../js/jquery-multi-select/css/multi-select.css" />

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
            <div class="top-nav clearfix">

                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search"> </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src="../images/OSAS/MAAM%20DEM.jpg"> <span class="username"><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="../config/logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->

            </div>
        </header>
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
                                <header class="panel-heading"> Event <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">
                                        Add <i class="fa fa-plus"></i>
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
                                        <table class="table table-striped table-hover table-bordered" batch-year='<?php echo $current_acadyear; ?>' id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Event Code</th>
                                                    <th>Event Name</th>
                                                    <th>Event Description</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th style="width:10%"> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
														
                                                    $view_query = mysqli_query($con,"SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE 
                                                    ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $code = $row["OrgEvent_Code"];
                                                        $name = $row["OrgEvent_NAME"];
                                                        $desc = $row["OrgEvent_DESCRIPTION"];										
                                                        $stat = $row["OrgEvent_STATUS"];
                                                        $date = $row["PROPDATE"];
                                                        $disstat = $row["OrgEvent_DISPLAY_STAT"];
                                                        $active = '';
                                                        if($disstat == 'Active'){
                                                            $display = "<center><span class='badge bg-success ' style='padding:10px;'>Active</span></center>";
                                                        }
                                                        else{
                                                            $display = "<center><span class='badge bg-important ' style='padding:10px;'>Inactive</span></center>";
                                                        }

                                                        if($disstat == 'Active' && $stat == 'Approved'){
                                                            $button = "<center>
                                                                        <a class='btn btn-default edit' style='background-color:#c7cbd6' href='javascript:;'><i class='fa fa-edit'></i></a> 
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Rejected'){
                                                            $button = "<center>
                                                                        <a class='btn btn-default edit' style='background-color:#c7cbd6' href='javascript:;'><i class='fa fa-edit'></i></a> 
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Pending'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>                                                                         <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
                                                                        </center>";
                                                        }
                                                        else{
                                                            $button = "<center>
                                                                        <a class='btn btn-info retrieve' href='javascript:;'><i class='fa fa-undo'></i></a>
                                                                    </center>";
                                                        }
                                                        
                                                        if($stat == 'Approved'){
                                                            $active = "<center><span class='label label-success'>$stat</span></center>";
                                                                
                                                        }
                                                        else if($stat == 'Rejected'){
                                                            $active = "<center><span class='label label-danger'>$stat</span></center>";
                                                            
                                                        }
                                                        else{
                                                            $active = "<center><span class='label label-primary'>$stat</span></center>";
                                                            
                                                        }
                                                            

                                                        echo "
                                                        <tr class=''>
                                                            <td>$code</td>
                                                            <td>$name</td>
                                                            <td>$desc</td>
                                                            <td>$date</td>
                                                            <td>$active</td>
                                                            <td style='width:200px'>
                                                                $button
                                                            </td>
                                                        </tr>
                                                            ";
                                                    }	
									       	
									           ?>
                                            </tbody>
                                            <tfoot>                                                                
                                                <tr>
                                                    <th>Event Code</th>
                                                    <th>Event Name</th>
                                                    <th>Event Description</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Event</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtname">
                            </div>
                            <div class="col-lg-6 form-group">
                                Organization
                                <select class="form-control input-sm" id="drporg">
                                <?php
                                    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) AS STAT FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR= '$current_acadyear' AND (SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) = 'TRUE'");

                                    $fillorg = ' <option disable selected value="default" >Please choose an Organization</option>';
                                    while($row = mysqli_fetch_assoc($view_query))
                                    {
                                        $val = $row['OrgForCompliance_ORG_CODE'];
                                        $name = $row['OrgAppProfile_NAME'];
                                        $fillorg = $fillorg . " <option value='".$val."' >".$name."</option>";

                                    }
                                    echo $fillorg;
                                ?>
                                </select>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="form-group">
                                    Date 
<!--                                <input type="text" placeholder="" data-mask="99/99/9999" class="form-control" id="txtdate">-->
                                    <input type="date" maxlength="10" class="form-control" id="txtdate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                Event Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
                        <h4 class="modal-title">Event</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtupdname">
                            </div>
                            <div class="col-lg-6 form-group">
                                Organization
                                <select class="form-control input-sm" id="drupdporg">
                                <?php
                                    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) AS STAT FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR= '$current_acadyear' AND (SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) = 'TRUE'");

                                    $fillorg = ' <option disable selected value="default" >Please choose an Organization</option>';
                                    while($row = mysqli_fetch_assoc($view_query))
                                    {
                                        $val = $row['OrgForCompliance_ORG_CODE'];
                                        $name = $row['OrgAppProfile_NAME'];
                                        $fillorg = $fillorg . " <option value='".$val."' >".$name."</option>";

                                    }
                                    echo $fillorg;
                                ?>
                                </select>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="form-group">
                                    Date 
<!--                                <input type="text" placeholder="" data-mask="99/99/9999" class="form-control" id="txtdate">-->
                                    <input type="date" maxlength="10" class="form-control" id="txtupddate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                Event Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="updclose" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <?php include('footer.php')?>
        <script type="text/javascript" src="../js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

        <!--script for this page only-->
        <script src="Organization/Event.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>


            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

    </body>

</html>
