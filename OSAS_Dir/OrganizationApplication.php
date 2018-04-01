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
        <link href="../css/clndr.css" rel="stylesheet">
        <link href="../js/css3clock/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../js/morris-chart/morris.css">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link href="../js/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
        <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />
        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../js/select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="../js/jquery-multi-select/css/multi-select.css" />
        <link rel="stylesheet" type="text/css" href="../js/bootstrap-fileupload/bootstrap-fileupload.css" /> </head>
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
                    <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src='../Avatar/<?php echo $user_check; ?>.png'> <span class="username"><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
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
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">Renew organization <i class="fa fa-plus"></i> </button>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
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
                                                    <th>Organization Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th>Renewal Status</th>
                                                    <th style="width:100px">Status</th>
                                                    <th style="width:1%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyedit">
                                                <?php 
                                        $view_query = mysqli_query($con,"SELECT  
                                        OrgAppProfile_APPL_CODE
                                        ,OrgAppProfile_DESCRIPTION
                                        ,OrgForCompliance_ORG_CODE
                                        ,OrgAppProfile_NAME
                                        ,OrgForCompliance_ADVISER
                                        ,OrgAppProfile_STATUS
                                        ,(SELECT COUNT(*) FROM r_org_accreditation_details WHERE OrgAccrDetail_DISPLAY_STAT = 'Active') AS A1
                                        , (SELECT COUNT(*) FROM t_org_accreditation_process A WHERE OrgAccrProcess_ORG_CODE = OFC.OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_DISPLAY_STAT='Active')  as A2 
                                        ,(SELECT IFNULL((SELECT WIZARD_CURRENT_STEP FROM r_application_wizard A WHERE A.WIZARD_ORG_CODE = OrgForCompliance_ORG_CODE),'1') ) AS STEP
                                        ,(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OFC.OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 ) = (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) AS TR,
                                        (SELECT COUNT(*) FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE = (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM `t_org_for_compliance` AS AZ WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR = '$current_acadyear' AND AZ.OrgForCompliance_ORG_CODE = OFC.OrgForCompliance_ORG_CODE  )) AS MYSTAT
                                        FROM `r_org_applicant_profile` AS OAP 
                                        INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE 
                                        WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active' ");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["OrgForCompliance_ORG_CODE"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $desc = $row["OrgAppProfile_DESCRIPTION"];
                                            $accstat = $row["TR"];
                                            $step = $row["STEP"];
                                            $mystat = $row["MYSTAT"];
                                            $curstep = '';
                                            if($step == 1)
                                                $curstep = '<td data-order=1><center style="padding-top:10px" ><span class="label label-primary">Newly Applicant</span>';
                                            else if($step == -1)
                                                $curstep = '<td data-order=2><center style="padding-top:10px" ><span class="label " style="background-color:#24F">Renewed Application</span>';
                                            else if($step == 2)
                                                $curstep = '<td data-order=3><center style="padding-top:10px" ><span class="label label-warning">Setting Mission and Vision</span>';
                                            else if($step == 3)
                                                $curstep = '<td data-order=4><center style="padding-top:10px"><span class="label label-default">Setting Position</span>';
                                            else if($step == 4)
                                                $curstep = '<td data-order=5><center style="padding-top:10px"><span class="label label-default" style="background-color:#286090">Setting Officer</span>';
                                            else if($step == 5)
                                            {
                                                if($accstat == 'TRUE' )
                                                    $curstep = '<td data-order=7><center style="padding-top:10px"><span class="label label-success">Accredited</span>';
                                                else  if($accstat == 'FALSE' )
                                                    $curstep = '<td data-order=6><center style="padding-top:10px" ><span class="label " style="background-color:#41CAC0">Completing Accreditation</span>';
                                            }
/// <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>
                                            //<a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
                                            echo "
                                            <tr class=''>
                                                <td>$code</td>
                                                <td>$name</td>
                                                <td>$desc</td>";
                                            
                                            if($mystat == 0)
                                            echo "
                                                <td><center><span class='label label-danger'>Expired</span></center></td>
                                                $curstep</center></td>
                                                <td style='width:200px'>
                                                    <center>
                                                         <a class='btn btn-info' href='javascript:;'  onClick='expiredSession()'><i class='fa fa-flag '></i></a>
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                            else
                                            echo "
                                                <td><center><span class='label label-success'>Active</span></center></td>
                                                $curstep</center></td>
                                                <td style='width:200px'>
                                                    <center>
                                                       
                                                         <a class='btn btn-info wizardOpen' href='javascript:;'><i class='fa fa-flag'></i></a>
                                                        
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                                
                                        }



									?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Organization Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th>Renewal Status</th>
                                                    <th style="width:100px">Status</th>
                                                    <th style="width:1%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
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
                                    <lbl id="lblname">Form Wizard</lbl> <span class=" pull-right">
                                    <a id="closewizardForm" class="fa fa-times"></a>
                                 </span> </header>
                                <div class="panel-body">
                                    <div class="stepwizard" id="asteps">
                                        <div class="stepwizard-row setup-panel">
                                            <center>
                                                <div class="stepwizard-step col-xs-2"> <a href="#step-1" id="aStep1" type="button" class="btn btn-success btn-circle">1</a>
                                                    <p><small>Adviser</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2"> <a href="#step-3" id="aStep3" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                    <p><small>Logo, Mission and Vision</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2"> <a href="#step-4" id="aStep4" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                    <p><small>Position</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2"> <a href="#step-5" id="aStep5" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                                    <p><small>Officer</small></p>
                                                </div>
                                                <div class="stepwizard-step col-xs-2"> <a href="#step-6" id="aStep6" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                                                    <p><small>Accreditation</small></p>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <form role="form">
                                        <div class="panel panel-primary setup-content" id="step-1">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">Who is the Adviser?</h3> </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="control-label">Adviser Name</label>
                                                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Adviser Name" id="txtadvname" /> </div>
                                                <div class="col-lg-12">
                                                    <button class="btn btn-primary nextBtn pull-right" type="button" id="next1">Next</button>
                                                    <button class="btn btn-info " type="button" id="btnStep1">Save for Now?</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary setup-content" id="step-3">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What do they Visualize?</h3> </div>
                                            <div class="panel-body">
                                                <div class="row"> 
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label">Upload Logo</label>
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail"> <img src="../Avatar/pup.png" alt="" style="height: 300px;width: 300px;" /> </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px;min-width: 300px; min-height: 250px; line-height: 20px;"></div>
                                                                <div> <span class="btn btn-white btn-file">
                                                
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip" ></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                    <input type="file" id ="fileupload" class="default" /> </span> <a href="#" class="btn btn-danger btn-sm fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a> </div>
                                                            </div>
                                                        </div> 
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Mission</label>
                                                        <textarea class="form-control" rows="14" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtmission" style="roverflow:auto;resize:none"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Vision</label>
                                                        <textarea class="form-control" rows="14" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtvision" style="roverflow:auto;resize:none"></textarea>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button class="btn btn-primary nextBtn pull-right" type="button" id="next3">Next</button>
                                                        <button class="btn btn-info " type="button" id="btnStep3">Save for Now?</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary setup-content" id="step-4">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What are the position in the organization?</h3> </div>
                                            <div class="panel-body">
                                                <div class="clearfix">
                                                    <div class="btn-group" id="btnposadd">
                                                        <button id="editable-sample_new2" data-toggle="modal" href="#AddPos" class="btn btn-success" type="button"> Add <i class="fa fa-plus"></i> </button>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-hover table-bordered" id="editable-sample2">
                                                    <thead>
                                                        <tr>
                                                            <th>Officer Position</th>
                                                            <th>Ocurrence</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblpos"> </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary nextBtn pull-right" type="button" id="next4">Next</button>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary setup-content" id="step-5">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">Who are the officer in the organization?</h3> </div>
                                            <div class="panel-body">
                                                <div class="clearfix">
                                                    <div class="btn-group" id="btnoffadd">
                                                        <button id="editable-sample_new3" data-toggle="modal" href="#AddOff" class="btn btn-success" type="button"> Add <i class="fa fa-plus"></i> </button>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-hover table-bordered" id="editable-sample3">
                                                    <thead>
                                                        <tr>
                                                            <th>Officer Position</th>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbloff"> </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary nextBtn pull-right" type="button" id="next5">Next</button>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary setup-content" id="step-6">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" style="color:white">What requirement do they have?</h3> </div>
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
                                                <div class="col-lg-12">
                                                    <button class="btn btn-success pull-right" type="button" id="btnFinish">Finish!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div> <a class='btn btn-cancel tar edit hidden' style='color:white' data-toggle='modal' id="openModalupd" href='#Edit' href='javascript:;'>Profile</a>
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
                                            <div class="target-sell"> </div>
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
            <div class="modal-dialog" style="width:500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Renewal</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="form-data">
                                    <div class="row" id="profile">
                                        <div class="col-lg-12 form-group"> Organization
                                            <select class="form-control input-sm" id="drporg">
                                                <?php
                                                $view_query = mysqli_query($con,"SELECT OrgAppProfile_APPL_CODE,OrgAppProfile_NAME FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE NOT IN ((SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR = '$current_acadyear'))");
                                                $fillorg = ' <option disable selected value="default" >Please choose an Organization</option>';
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $val = $row['OrgAppProfile_APPL_CODE'];
                                                    $name = $row['OrgAppProfile_NAME'];
                                                    $fillorg = $fillorg . " <option value='".$val."' >".$name."</option>";

                                                }
                                                
                                                echo $fillorg;
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 form-group desc"> Organization Description
                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
                        <h4 class="modal-title">Add Student</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="form-data2">
                                    <div class="row" id="profile">
                                        <div class="col-lg-6 form-group"> Organization Application Code
                                            <input name="studno" disabled type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" id="txtupdcode"> </div>
                                        <div class="col-lg-6 form-group"> Organization Name
                                            <input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdname"> </div>
                                        <div class="col-lg-12 form-group"> Organization Description
                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                                        </div>
                                        <div class="col-lg-3 form-group hidethis">
                                            <input type="checkbox" id="chkupdacc" name="chkupdacc" class="checkbox form-control" style="width: 20px">
                                            <label for="chkacc">Accredited</label>
                                        </div>
                                    </div>
                                    <input name="studno" type="text" class="form-control hidden" id="txtgetid"> </form>
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
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddPos" class="modal fade">
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Officer Position</h4> </div>
                    <div class="modal-body">
                        <form method="post" id="posform-data">
                            <div class="row" style="padding-left:15px;padding-top:10px">
                                <div class="col-lg-12"> Officer Position
                                    <input type="text" class="form-control" placeholder="ex. President" id="txtposcode"> </div>
                                <div class="col-lg-12"> Occurence
                                    <input type="number" value=1 class="form-control" placeholder="1" id="txtocc"> </div>
                                <div class="col-lg-12" style="padding-top:10px"> Description
                                    <textarea class="form-control" placeholder="ex. Leader of the Organization" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtposdesc"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="close2" type="button">Close</button>
                        <button class="btn btn-success " id="submit-data2" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddOff" class="modal fade">
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Organization Officer</h4> </div>
                    <div class="modal-body">
                        <form method="post" id="offform-data">
                            <div class="row" style="padding-left:15px;padding-top:10px">
                                <div class="col-lg-12" style="padding-top:10px"> Student
                                    <select class="form-control input-sm m-bot15 selectYear" id="drpstud"> </select>
                                </div>
                                <div class="col-lg-12" style="padding-top:10px"> Position
                                    <select class="form-control input-sm m-bot15 selectYear" id="drppos"> </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="close3" type="button">Close</button>
                        <button class="btn btn-success " id="btnsubmitoff" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <?php include('footer.php')?>
            <!--script for this page only-->
            <script src="Organization/OrganizationApplication.js"></script>
            <script type="text/javascript" src="../js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
            <!-- END JAVASCRIPTS -->
            <script>
                function expiredSession() {
                    swal('Expired', 'Session is Expired, you can`t modify the transaction here! It should remain as is', 'error');
                }
                $(document).ready(function () {
                    $('#wizardForm').hide();
                    $('.hidethis').hide();
                    $('.desc').hide();
                    wizardOpen = $('.wizardOpen');
                    wizardOpen.on('click', function () {
                        $('#tableForm').slideToggle();
                        $('#wizardForm').slideToggle();
                    });
                    $('#closewizardForm').click(function () {
                        $('#tableForm').slideToggle();
                        $('#wizardForm').slideToggle();
                    });
                    var navListItems = $('div.setup-panel div a')
                        , allWells = $('.setup-content')
                        , allNextBtn = $('.nextBtn');
                    allWells.hide(100);
                    navListItems.click(function (e) {
                        e.preventDefault();
                        var $target = $($(this).attr('href'))
                            , $item = $(this);
                        if (!$item.hasClass('disabled')) {
                            navListItems.removeClass('btn-success').addClass('btn-default');
                            $item.addClass('btn-success');
                            allWells.hide();
                            $target.show();
                            $target.find('input:eq(0)').focus();
                        }
                    });
                    allNextBtn.click(function () {
                        var curStep = $(this).closest(".setup-content")
                            , curStepBtn = curStep.attr("id")
                            , nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a")
                            , curInputs = curStep.find("input[type='text'],input[type='url']")
                            , isValid = true;
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
                $("button[id='savemuna']").on('click', function () {
                    swal({
                        title: "Are you sure?"
                        , text: "You want to temporarily save the steps?"
                        , type: "warning"
                        , showCancelButton: true
                        , confirmButtonColor: '#9DD656'
                        , confirmButtonText: 'Yes, Save it!'
                        , cancelButtonText: "No, cancel it!"
                        , closeOnConfirm: false
                        , closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            swal({
                                title: "Woaah, that's neat!"
                                , text: "You have successfully save the current step. please continue it if you are ready."
                                , type: "success"
                                , showCancelButton: false
                                , confirmButtonColor: '#9DD656'
                                , confirmButtonText: 'Ok'
                            }, function (isConfirm) {
                                if ($("#step-1").css("display") == 'block') {
                                    $("#btnStep1").trigger("click");
                                }
                                else if ($("#step-2").css("display") == 'block') {
                                    $("#btnStep2").trigger("click");
                                }
                                else if ($("#step-3").css("display") == 'block') {
                                    $("#btnStep3").trigger("click");
                                }
                                else if ($("#step-4").css("display") == 'block') {
                                    $("#btnStep4").trigger("click");
                                }
                                else if ($("#step-5").css("display") == 'block') {
                                    $("#btnFinish").trigger("click");
                                }
                                location.reload();
                            });
                        }
                        else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                        }
                    });
                });
                jQuery(document).ready(function () {
                    EditableTable.init();
                    EditableTable2.init();
                    EditableTable3.init();
                });
                window.alert = function () {};
            </script>
    </body>

</html>