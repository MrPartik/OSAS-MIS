<!DOCTYPE html>
<html>
<title>OSAS - Remittance</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Remittance</a></li> </ul></div>";
$currentPage ='OSAS_Remittance';
include ('header.php');
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
                                <header class="panel-heading"> Remittance <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">Add <i class="fa fa-plus"></i> </button>
                                                <!-- <button id="btnrequest" data-toggle="modal" id="openAddmodal" href="#Request" class="btn btn-info" style="margin-left:5px">Request <i class="fa fa-folder-open"></i>
                                                </button> -->
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                            </div>
                                        </div>
                                        <div class="space15"></div>
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th class="hidden">id</th>
                                                    <th>Remittance No.</th>
                                                    <th>Organization</th>
                                                    <th>Overview</th>
                                                    <th>Description</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Date Issued</th>
                                                    <!--
                                                    <th style="width:1%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $view_query = mysqli_query($con," SELECT OrgRemittance_NUMBER,OrgRemittance_ID,OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT  ,OrgRemittance_DESC,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M %d, %Y') AS DATE,OrgRemittance_APPROVED_STATUS AS APSTAT  FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' ORDER BY OrgRemittance_NUMBER ASC ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $id = $row["OrgRemittance_ID"];
                                                        $number = $row["OrgRemittance_NUMBER"];
                                                        $name = $row["OrgAppProfile_NAME"];
                                                        $send = $row["OrgRemittance_SEND_BY"];
                                                        $rec = $row["OrgRemittance_REC_BY"];
                                                        $amount = $row["AMOUNT"];
                                                        $desc = $row["OrgRemittance_DESC"];
                                                        $date = $row["DATE"];
                                                        $stat = $row["APSTAT"];

                                                        {
                                                            echo "
                                                            <tr class=''>
                                                                <td class='hidden'>$id</td>
                                                                <td><center>$number</center></td>
                                                                <td style='width:200px'>$name</td>
                                                                <td style='width:280px'><label>Send by: </label> $send<br><label>Received by: </label> $rec</td>

                                                                <td><label>Amount: </label> $amount<br/><label>Description: </label> $desc</td>
                                                                
                                                                <td><label>$date</label></td>
                                                               <!-- <td style='width:150px'>
                                                                    <center>
                                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a> 
                                                                        <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>
                                                                    </center>
                                                                </td>-->
                                                            </tr>
                                                                    ";
                                                            
                                                        }
                                                    }

                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="hidden">id</th>
                                                    <th style="width:  10%">Remittance No.</th>
                                                    <th>Organization</th>
                                                    <th style="width:  20%">Overview</th>
                                                    <th>Description</th>
                                                    <!-- <th>Status</th> -->
                                                    <th style="width:15%">Date Issued</th>
                                                    <!--
                                                    <th style="width:1%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
-->
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
        <!-- modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="lblremit">Remittance</h4> </div>
                    <div class="modal-body">
                        <form method="post" id="form-data">
                            <div class="row">
                                <div class="col-lg-6 form-group"> Organization Name
                                    <select class="form-control input-sm" id="drporg">
                                        <?php
                                        $view_query = mysqli_query($con," SELECT OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgAppProfile_NAME,(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) AS STAT FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR= '$current_acadyear' AND (SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) = 'TRUE'
                                        ");
                                
                                        $fillorg = ' <option disabled selected value="default" >Please choose an Organization</option>';
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $val = $row['OrgForCompliance_OrgApplProfile_APPL_CODE'];
                                            $name = $row['OrgAppProfile_NAME'];
                                            $fillorg = $fillorg . " <option value='".$val."' >".$name."</option>";

                                        }
                                        echo $fillorg;
                                    ?>
                                    </select>
                                </div>
                                <div class="col-lg-6"> Current Money
                                    <input type="text" min="1" class="form-control" disabled id="txtcurmon"> </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-6"> Send By
                                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="txtname"> </div>
                                <div class="col-lg-6"> Amount
                                    <input type="number" min="1" class="form-control" placeholder="ex. 500" id="txtamount"> </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-12 " style="padding-top:10px"> Description
                                    <textarea class="form-control" placeholder="ex. Description" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
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
                        <h4 class="modal-title"><i class="fa fa-money"></i>   Edit Remittance</h4> </div>
                    <div class="modal-body">
                        <form method="post" id="updform-data">
                            <div class="row">
                                <div class="col-lg-12 form-group"> Organization Name
                                    <select disabled class="form-control input-sm" id="upddrporg">
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
                                <div class="col-lg-6"> Send By
                                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="updtxtname"> </div>
                                <div class="col-lg-6"> Amount
                                    <input type="number" min="1" class="form-control" placeholder="ex. 500" id="updtxtamount"> </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-12 " style="padding-top:10px"> Description
                                    <textarea class="form-control" placeholder="ex. Description" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="updtxtdesc"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Request" class="modal fade">
            <div class="modal-dialog" style="width:70%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-money"></i> Remittance Request</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample2">
                                <thead>
                                    <tr>
                                        <th>Remittance No.</th>
                                        <th>Organization</th>
                                        <th>Overview</th>
                                        <th>Description</th>
                                        <th>Date Issued</th>
                                        <th style='width:130px'>
                                            <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $view_query = mysqli_query($con," SELECT OrgRemittance_NUMBER,OrgRemittance_ID,OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT  ,OrgRemittance_DESC,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M %d, %Y') AS DATE  FROM t_org_remittance
                                        INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                        INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                        WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Pending' ORDER BY OrgRemittance_NUMBER ASC ");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $number = $row["OrgRemittance_NUMBER"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $send = $row["OrgRemittance_SEND_BY"];
                                            $rec = $row["OrgRemittance_REC_BY"];
                                            $amount = $row["AMOUNT"];
                                            $desc = $row["OrgRemittance_DESC"];
                                            $date = $row["DATE"];

                                            echo "
                                            <tr class=''>
                                                <td><center>$number</center></td>
                                                <td style='width:200px'>$name</td>
                                                <td style='width:280px'><label>Send by: </label> $send<br/>
                                                    <label>Receive by: </label> $rec</td>
                                                <td><label>Amount: </label> $amount<br/><label>Description: </label> $desc</td>
                                                <td><label>$date</label></td>
                                                <td>
                                                    <center>
                                                        <a class='btn btn-success approved' style='color:white' href='javascript:;'><i class='fa fa-thumbs-o-up'></i></a> 
                                                        <a class='btn btn-danger reject' style='color:white' href='javascript:;'><i class='fa fa-thumbs-o-down'></i></a> 
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                        }

                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Remittance No.</th>
                                        <th>Organization</th>
                                        <th>Overview</th>
                                        <th>Description</th>
                                        <th>Date Issued</th>
                                        <th style='width:100px'>
                                            <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Placed js at the end of the document so the pages load faster -->
        <!--Core js-->
        <?php include("footer.php"); ?>
            <!--script for this page only-->
            <script src="Organization/Remittance.js"></script>
            <!-- END JAVASCRIPTS -->
            <script>
                $(document).ready(function () {
                    $('#btnprint').click(function () {
                        var items = [];
                        var rows = $('#editable-sample').dataTable()
                            .$('tr', {
                                "filter": "applied"
                            });
                        $(rows).each(function(index, el) {
                            items.push($(this).closest('tr').children('td:first').text());

                        })                        
                        window.open('Print/Remittance_Print.php?items=' + items, '_blank');
                    });
                    

                });
                jQuery(document).ready(function () {
                    EditableTable.init();
                });
            </script>
    </body>

</html>
