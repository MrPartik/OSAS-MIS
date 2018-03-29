<!DOCTYPE html>
<html>
<title>OSAS - Remittance</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Remittance</a></li> </ul></div>";
$currentPage ='OSAS_Remittance';
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
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <img alt="" src="../images/OSAS/MAAM%20DEM.jpg"> <span code="<?php echo $user_check; ?>" class="username"><?php echo $user_check; ?> </span> <b class="caret"></b> </a>
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
                                <header class="panel-heading"> Remittance <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">Add <i class="fa fa-plus"></i>
                                                </button>
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
                                                    <th>Remittance Number</th>
                                                    <th>Organization</th>
                                                    <th>Overview</th>
                                                    <th>Description</th>
                                                    <th>Date Issued</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $view_query = mysqli_query($con," SELECT OrgRemittance_NUMBER,OrgRemittance_ID,OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT  ,OrgRemittance_DESC,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M %d, %Y') AS DATE  FROM t_org_remittance
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
                                                        
                                                        echo "
                                                        <tr class=''>
                                                            <td class='hidden'>$id</td>
                                                            <td style='width:250px'><label>$number</label></td>
                                                            <td style='width:200px'><label>$name</label></td>
                                                            <td style='width:280px'><label>Send by: </label> $send<br/>
                                                                <label>Receive by: </label> $rec</td>
                                                            <td><label>Amount: </label> $amount<br/><label>Description: </label> $desc</td>
                                                            <td><label>$date</label></td>
                                                            <td style='width:150px'>
                                                                <center>
                                                                    <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>
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
                                                    <th class="hidden">id</th>
                                                    <th>Remittance Number</th>
                                                    <th>Organization</th>
                                                    <th>Overview</th>
                                                    <th>Description</th>
                                                    <th>Date Issued</th>
                                                    <th>Action</th>
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
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="lblremit">Remittance</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-data">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    Organization Name
                                    <select class="form-control input-sm" id="drporg">
                                    <?php
                                        $view_query = mysqli_query($con," SELECT OrgForCompliance_ORG_CODE,CONCAT(OrgForCompliance_ORG_CODE,' - ',OrgAppProfile_NAME) AS NAME,(SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) AS STAT FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_BATCH_YEAR= '$current_acadyear' AND (SELECT IF((SELECT COUNT(*) FROM t_org_accreditation_process A WHERE A.OrgAccrProcess_ORG_CODE =  OrgForCompliance_ORG_CODE AND A.OrgAccrProcess_IS_ACCREDITED = 1 )= (SELECT COUNT(*) FROM r_org_accreditation_details B WHERE B.OrgAccrDetail_DISPLAY_STAT = 'Active'),'TRUE','FALSE')) = 'TRUE'
                                        ");
                                
                                        $fillorg = ' <option disable selected value="default" >Please choose an Organization</option>';
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $val = $row['OrgForCompliance_ORG_CODE'];
                                            $name = $row['NAME'];
                                            $fillorg = $fillorg . " <option value='".$val."' >".$name."</option>";

                                        }
                                        echo $fillorg;
                                    ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    Current Money <input type="text" min="1" class="form-control" disabled id="txtcurmon">
                                </div>
                            </div>

                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-6">
                                    Send By <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="txtname">
                                </div>
                                <div class="col-lg-6">
                                    Amount <input type="number" min="1" class="form-control" placeholder="ex. 500" id="txtamount">
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-8 " style="padding-top:10px">
                                    Description<textarea class="form-control" placeholder="ex. Description" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Remittance</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="updform-data">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    Organization Name
                                    <select class="form-control input-sm" id="upddrporg">
                                    <?php
                                        $view_query = mysqli_query($con," SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' ");
                                
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
                                <div class="col-lg-6">
                                    Send By <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="updtxtname">
                                </div>
                                <div class="col-lg-6">
                                    Amount <input type="number" min="1" class="form-control" placeholder="ex. 500" id="updtxtamount">
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-lg-8 " style="padding-top:10px">
                                    Description<textarea class="form-control" placeholder="ex. Description" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="updtxtdesc"></textarea>
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
        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="../js/jquery-1.8.3.min.js"></script>
        <script src="../bs3/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../js/jquery.scrollTo.min.js"></script>
        <script src="../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="../js/jquery.nicescroll.js"></script>

        <script type="text/javascript" src="../js/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>
        <script src="../js/select2/select2.js"></script>
        <script src="../js/select-init.js"></script>

        <!--common script init for all pages-->
        <script src="../js/scripts.js"></script>

        <!--script for this page only-->
        <script src="Organization/Remittance.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>
            $(document).ready(function() {
                $('#btnprint').click(function() {
                    var items = [];
                    var table = $('#editable-sample').DataTable();
                    jQuery(table.fnGetNodes()).each(function() {
                        items.push($(this).closest('tr').children('td:first').text());
                    });
                    window.open('Print/Remittance_Print.php?items=' + items, '_blank');
                });

            });
            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

    </body>

</html>
