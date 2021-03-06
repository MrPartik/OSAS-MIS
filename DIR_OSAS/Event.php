<!DOCTYPE html>
<html>
<title>OSAS - Event</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Event Management</a></li> </ul></div>";
$currentPage ='OSAS_Event';
include ("header.php");
?>
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
                                                <button id="btnrequest" data-toggle="modal" href="#EventRequest" class="btn btn-info" style="margin-left:5px">
                                                    Request <i class="fa fa-folder-open"></i> </button>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
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
                                                    <th>Event Status</th>
                                                    <th>Approval Status</th>
                                                    <th style="width:10%"> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
														
                                                    $view_query = mysqli_query($con,"SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') > DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'Sa future',IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') = DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'On Going','Tapos Na') ) AS EVSTAT, OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                                WHERE OrgEvent_STATUS = 'Rejected' OR OrgEvent_STATUS = 'Approved' OR OrgEvent_STATUS = 'Cancelled'
                                                    ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $code = $row["OrgEvent_Code"];
                                                        $name = $row["OrgEvent_NAME"];
                                                        $desc = $row["OrgEvent_DESCRIPTION"];										
                                                        $stat = $row["OrgEvent_STATUS"];
                                                        $date = $row["PROPDATE"];
                                                        $evstat = $row["EVSTAT"];
                                                        $disstat = $row["OrgEvent_DISPLAY_STAT"];
                                                        $active = '';
                                                        if($disstat == 'Active'){
                                                            $display = "<center><span class='badge bg-success ' style='padding:10px;'>Active</span></center>";
                                                        }
                                                        else{
                                                            $display = "<center><span class='badge bg-important ' style='padding:10px;'>Inactive</span></center>";
                                                        }

                                                        if($disstat == 'Active' && $stat == 'Approved' && $evstat == 'Sa future'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success ApproveEdit' style='color:white' data-toggle='modal' href='#ApproveEdit' href='javascript:;'><i class='fa fa-edit'></i></a>                                                                         
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Approved'){
                                                            $button = "<center>
                                                                        <a class='btn btn-info info' style='color:white' data-toggle='modal' href='#Info' href='javascript:;'><i class='fa fa-info-circle'></i></a>                                                                         
                                                                        </center>";
                                                        }                                                        
                                                        else if($disstat == 'Active' && $stat == 'Rejected'){
                                                            $button = "<center>
                                                            <a class='btn btn-info info' style='color:white' data-toggle='modal' href='#Info' href='javascript:;'><i class='fa fa-info-circle'></i></a>                                                                             </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Pending'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>                                                                         
                                                                        <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
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
                                                        
                                                        if($stat == 'Rejected'){
                                                           $evactive = "<center><span class='label label-danger'>Cancel</span></center>";
                                                        }
                                                        else if($evstat == 'On Going'){
                                                            $evactive = "<center><span class='label label-warning'>On Going</span></center>";
                                                                
                                                        }
                                                        else if($evstat == 'Sa future'){
                                                            $evactive = "<center><span class='label label-success'>Incoming</span></center>";
                                                            
                                                        }
                                                        else{
                                                            $evactive = "<center><span class='label label-primary'>Done</span></center>";
                                                            
                                                        }                                                            

                                                        echo "
                                                        <tr class=''>
                                                            <td>$code</td>
                                                            <td>$name</td>
                                                            <td>$desc</td>
                                                            <td>$date</td>
                                                            <td>$evactive</td>
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
                                                    <th>Event Status</th>
                                                    <th>Approval Status</th>
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
                                *Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtname">
                            </div>
                            <div class="col-lg-6 form-group">
                                *Organization
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
                                    *Date
                                    <input type="date" maxlength="10" class="form-control" id="txtdate">
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                *Event Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                            </div>
                            <div class="col-lg-12 form-group">
                                *Concept Paper etc...<input class="form-control" type ="file" style="margin: 0px 202.5px 0px 0px;resize:none" id="docFile">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="close" class="btn btn-default" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="submit-data" type="button"><u>S</u>ave</button>
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
                        <button data-dismiss="modal" id="updclose" class="btn btn-default" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button"><u>S</u>ave</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ApproveEdit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Event</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtappupdname">
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="form-group">
                                    Date 
                                    <input type="date" maxlength="10" class="form-control" id="txtappupddate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                Event Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtappupddesc"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="updappclose" class="btn btn-default" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="updappsubmit-data" type="button"><u>S</u>ave</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="EventRequest" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"> Request  <i class="fa fa fa-folder-open"></i> </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample2">
                                <thead>
                                    <tr>
                                        <th>Event Code</th>
                                        <th>Event Name</th>
                                        <th>Event Description</th>
                                        <th>Date</th>
                                        <th>Event Status</th>
                                        <th>Approval Status</th>
                                        <th> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>

                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
                                                    $view_query = mysqli_query($con,"SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') > DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'Sa future',IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') = DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'On Going','Tapos Na') ) AS EVSTAT, OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                                WHERE OrgEvent_STATUS = 'Pending'
                                                    ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $code = $row["OrgEvent_Code"];
                                                        $name = $row["OrgEvent_NAME"];
                                                        $desc = $row["OrgEvent_DESCRIPTION"];										
                                                        $stat = $row["OrgEvent_STATUS"];
                                                        $date = $row["PROPDATE"];
                                                        $evstat = $row["EVSTAT"];
                                                        $disstat = $row["OrgEvent_DISPLAY_STAT"];
                                                        $active = '';
                                                        if($disstat == 'Active'){
                                                            $display = "<center><span class='badge bg-success ' style='padding:10px;'>Active</span></center>";
                                                        }
                                                        else{
                                                            $display = "<center><span class='badge bg-important ' style='padding:10px;'>Inactive</span></center>";
                                                        }

                                                        if($disstat == 'Active' && $stat == 'Approved' && $evstat == 'Sa future'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success ApproveEdit' style='color:white' data-toggle='modal' href='#ApproveEdit' href='javascript:;'><i class='fa fa-edit'></i></a>                                                                         
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Approved'){
                                                            $button = "<center>
                                                                        <a class='btn btn-info info' style='color:white' data-toggle='modal' href='#Info' href='javascript:;'><i class='fa fa-info-circle'></i></a>                                                                         
                                                                        </center>";
                                                        }                                                        
                                                        else if($disstat == 'Active' && $stat == 'Rejected'){
                                                            $button = "<center>
                                                            <a class='btn btn-info info' style='color:white' data-toggle='modal' href='#Info' href='javascript:;'><i class='fa fa-info-circle'></i></a>                                                                             </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Pending'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>                                                                         
                                                                        <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
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
                                                        
                                                        if($stat == 'Rejected'){
                                                           $evactive = "<center><span class='label label-danger'>Cancel</span></center>";
                                                        }
                                                        else if($evstat == 'On Going'){
                                                            $evactive = "<center><span class='label label-warning'>On Going</span></center>";
                                                                
                                                        }
                                                        else if($evstat == 'Sa future'){
                                                            $evactive = "<center><span class='label label-success'>Incoming</span></center>";
                                                            
                                                        }
                                                        else{
                                                            $evactive = "<center><span class='label label-primary'>Done</span></center>";
                                                            
                                                        }                                                            

                                                        echo "
                                                        <tr class=''>
                                                            <td>$code</td>
                                                            <td>$name</td>
                                                            <td>$desc</td>
                                                            <td>$date</td>
                                                            <td>$evactive</td>
                                                            <td>$active</td>
                                                            <td>
                                                                <center>
                                                                    <a class='btn btn-success btnApprove'> <i class='fa fa-thumbs-o-up'></i> </a>
                                                                    <a class='btn btn-danger btnReject'> <i class='fa  fa-thumbs-o-down'></i> </a>
                                                                </center>
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
                                        <th>Event Status</th>
                                        <th>Approval Status</th>
                                        <th> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal"  class="btn btn-default" type="button"><u>C</u>lose</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Info" class="modal fade">
            <div class="modal-dialog" style="width:50%">
                <div class="modal-content">
                    <div class="col-md-12">
                        <!--widget start-->
                        <aside class="profile-nav alt">
                            <section class="panel" id="InfoBody">
                                <div class='twt-feed maroon-bg'>                    
                                    <div class='corner-ribon black-ribon'>
                                        <i class='fa fa-user'></i>
                                    </div>
                                    <div class='fa fa-user wtt-mark'>
                                    </div> 
                                    <a href='#'>
                                        <img alt="" src="../Avatar/Default-Organization.png">
                                    </a>
                                    <h1 id='lblorgname'>$orgname - $orgcode </h1>
                                    <p id='lblorgdesc'>$orgdesc</p>
                                </div>                               
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="javascript:;"> <i class="fa fa-money"></i> Money <span class="badge label-label pull-right r-activity" id="lblmoney">'.$amount2.'</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-bookmark"></i>Event Code<span class="badge label-label pull-right r-activity" id="lblremitnum" item="'.$remitnum.'">'.$remitnum.'</span> </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-bookmark"></i>Event Name<span class="badge label-label pull-right r-activity" id="lblremitnum" item="'.$remitnum.'">'.$remitnum.'</span> </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> <i class="fa fa-comments-o"></i>Event Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-bookmark"></i>Date<span class="badge label-label pull-right r-activity" id="lblremitnum" item="'.$remitnum.'">'.$remitnum.'</span> </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-info-circle"></i>Event Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-info-circle"></i>Approval Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a>
                                    </li>
                                </ul>
                            </section>
                        </aside>
                        <!--widget end-->
                    </div>
                </div>
            </div>
        </div>       
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <?php include('footer.php')?>
        <script type="text/javascript" src="../ASSETS/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

        <!--script for this page only-->
        <script src="Organization/Event.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>


            jQuery(document).ready(function() {
                EditableTable.init();
                $('#btnprint').click(function () {
                    var items = [];
                    var rows = $('#editable-sample').dataTable()
                        .$('tr', {
                            "filter": "applied"
                        });
                    $(rows).each(function(index, el) {
                        items.push($(this).closest('tr').children('td:first').text());

                    })                        
                    window.open('Print/Event_Print.php?items=' + items, '_blank');
                });
                document.onkeyup = function(e) {
                    if (e.altKey && e.which == 83) {
                        if($('#Add').is(':visible')){
                            $('#submit-data').click();
                        }
                        else if($('#Edit').is(':visible')){
                            $('#updsubmit-data').click();
                        }

                    }
                    else if (e.altKey && e.which == 67) {
                        if($('#Add').is(':visible')){
                            $('#close').click();
                        }
                        else if($('#Edit').is(':visible')){
                            $('#updclose').click();
                        }

                    }
                };
            });

        </script>

    </body>

</html>
