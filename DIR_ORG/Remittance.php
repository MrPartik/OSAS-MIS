<!DOCTYPE html>
<html>
<title>OSAS - Application and Compliance</title>
<?php 
$breadcrumbs="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a class='current' href='Remittance.php'>Remittance</a></li>
</ul>
</div>"; 
$currentPage ='Org_Remit'; 
//ANDTIOOOOOOO    
include('header.php'); 
$compcode = $referenced_user;

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
                                                <th class="hidden">Remittance ID</th>
                                                <th>Remittance No</th>
                                                <th>Description</th>
                                                <th>Send By</th>
                                                <th>Received By</th>
                                                <th>Amount</th>
                                                <th>Date Issued</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $view_query = mysqli_query($con," SELECT OrgRemittance_ID,OrgAppProfile_NAME,OrgRemittance_NUMBER,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT  ,OrgRemittance_DESC,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M %d, %Y') AS DATE  FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE  = '$compcode' ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $remID = $row["OrgRemittance_ID"];
                                                        $remNo = $row["OrgRemittance_NUMBER"];
                                                        $name = $row["OrgAppProfile_NAME"];
                                                        $send = $row["OrgRemittance_SEND_BY"];
                                                        $rec = $row["OrgRemittance_REC_BY"];
                                                        $amount = $row["AMOUNT"];
                                                        $desc = $row["OrgRemittance_DESC"];
                                                        $date = $row["DATE"];
                                                        
                                                        echo "
                                                        <tr class=''>
                                                            <td class='hidden'> $remID </td>
                                                            <td> $remNo </td>
                                                            <td>$desc </td>
                                                            <td> $send </td>
                                                            <td> $rec </td>
                                                            <td>$amount </td>
                                                            <td>$date </td>

                                                        </tr>
                                                                ";
                                                    }

                                                ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="hidden">Remittance ID</th>
                                                <th>Remittance No</th>
                                                <th>Description</th>
                                                <th>Send By</th>
                                                <th>Received By</th>
                                                <th>Amount</th>
                                                <th>Date Issued</th>
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
    <!-- modal -->

    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="../ASSETS/js/jquery-1.8.3.min.js"></script>
    <script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
    <script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../ASSETS/js/jquery.nicescroll.js"></script>

    <script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../ASSETS/js/sweetalert/sweetalert.min.js"></script>
    <script src="../ASSETS/js/select2/select2.js"></script>
    <script src="../ASSETS/js/select-init.js"></script>

    <!--common script init for all pages-->
    <script src="../ASSETS/js/scripts.js"></script>

    <!--script for this page only-->
    <script src="Remittance/Remittance.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {


        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
