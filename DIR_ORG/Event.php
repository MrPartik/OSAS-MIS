<!DOCTYPE html>
<html>
<title>OSAS - Event</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Home</a>  </li>
<li><a class='current'' href='#'>Event Management</a></li> </ul></div>";
$currentPage ='Org_Event';
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
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
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
                                                    WHERE OrgEvent_OrgCode  = '$user_check' ");
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
                                                                        <a class='btn btn-info edit'  data-toggle='modal' href='#Edit'><i class='fa fa-info-circle'></i></a> 
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Rejected'){
//                                                            $button = "<center>
//                                                                        <a class='btn btn-default edit' style='background-color:#c7cbd6' href='javascript:;'><i class='fa fa-edit'></i></a> 
//                                                                        </center>";
                                                            $button = "<center>
                                                                        <a class='btn btn-info edit'   data-toggle='modal' href='#Edit'><i class='fa fa-info-circle'></i></a> 
                                                                        </center>";
                                                        }
                                                        else if($disstat == 'Active' && $stat == 'Pending'){
                                                            $button = "<center>
                                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' ><i class='fa fa-edit'></i></a>                                                                         <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
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
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
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
                            <div class="col-lg-12 form-group">
                                Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtname">
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
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Event</h4>
                    </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                Event Name<input type="text" class="form-control" placeholder="ex. Commits General Assembly" id="txtupdname">
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="form-group">
                                    Date 
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
                        <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <?php  include('../config/NotificationApproval.php') ?>
        <?php include('footer.php')?>
        <script type="text/javascript" src="../ASSETS/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

        <!--script for this page only-->
        <script src="Event/Event.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>


            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

    </body>

</html>
