<!DOCTYPE html>
<html>
<?php 
$breadcrumbs="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a class='current' href='#.php'>Cashflow Statement</a></li>
</ul>
</div>"; 
$currentPage ='Org_Cflow'; 
//ANDTIOOOOOOO    
include('header.php'); 
$compcode = $referenced_user;
include('../config/connection.php');
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
        <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
            <ul class="nav top-menu">
                <!-- notification dropdown start-->
                <?php include('../config/Notification.php'); ?>
                <!-- notification dropdown end -->
            </ul>
        <!--  notification end -->
        </div>
        <div class="top-nav clearfix">

            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder=" Search"> </li>
                <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                            <?php
                                $picpath = '../Avatar/'.$user_check.'.png';
                                                       
                                
                                if (file_exists($picpath)) {
                                    
                                }
                                else {
                                    $picpath = '../Avatar/Default-Organization.png';
                                }
                          
                            ?>
                            <img src="<?php echo $picpath; ?>" />
                            <span class="username" code='<?php echo $referenced_user  ?>'>
                            <?php echo $user_check; ?> </span> <b class="caret"></b> </a>
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
                            <header class="panel-heading"> Cashflow Statement <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                            <div class="panel-body">
                                <div class="adv-table editable-table ">
                                    <div class="clearfix">
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th class="hidden">Reference</th>
                                                <th>Reference</th>
                                                <th>Description</th>
                                                <th>Collection</th>
                                                <th>Expense</th>
                                                <th>Balance</th>
                                                <th>Remarks</th>
                                                <th>Date Issued</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    
                                                    $query = " SELECT OrgCashFlowStatement_ID,
    IF(
        OrgCashFlowStatement_COLLECTION IS NULL,
        (
        SELECT
            OrgVoucher_CHECKED_BY
        FROM
            `t_org_voucher`
        WHERE
            OrgVoucher_CASH_VOUCHER_NO = OrgCashFlowStatement_ITEM
    ),
        (
        SELECT
            OrgRemittance_DESC
        FROM
            `t_org_remittance`
        WHERE
            OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM
    )
    ) AS DESCRIPTION,
    IF(
        OrgCashFlowStatement_COLLECTION IS NULL,
        (
        SELECT
            OrgCashFlowStatement_ITEM
        FROM
            `t_org_voucher`
        WHERE
            OrgVoucher_CASH_VOUCHER_NO = OrgCashFlowStatement_ITEM
    ),
        (
        SELECT
            OrgCashFlowStatement_ITEM
        FROM
            `t_org_remittance`
        WHERE
            OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM
    )
    ) AS REF,
    IF(
        OrgCashFlowStatement_COLLECTION IS NOT NULL,
        CONCAT(
            '₱',
            FORMAT(
                OrgCashFlowStatement_COLLECTION,
                3
            )
        ),
        ''
    ) AS COLLECTION,
    IF(
        OrgCashFlowStatement_EXPENSES IS NOT NULL,
        CONCAT(
            '₱',
            FORMAT(
                OrgCashFlowStatement_EXPENSES,
                3
            )
        ),
        ''
    ) AS EXPENSES,
    CONCAT(
        '₱',
        FORMAT(
            (
            SELECT
                IFNULL(SUM(OrgRemittance_AMOUNT),
                0)
            FROM
                t_org_remittance
            WHERE
                OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgRemittance_DATE_ADD <= OrgCashFlowStatement_DATE_ADD
        ) -(
        SELECT
            IFNULL(SUM(OrgVouchItems_AMOUNT),
            0)
        FROM
            `t_org_voucher_items`
        INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
        WHERE
            OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgVouchItems_DATE_ADD <= OrgCashFlowStatement_DATE_ADD AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active'
    ),
    3
        )
    ) AS BALANCE,
    OrgCashFlowStatement_REMARKS AS REMARKS,
    DATE_FORMAT(
        OrgCashFlowStatement_DATE_ADD,
        '%M %d, %Y'
    ) AS DATEISSUED
FROM
    `t_org_cash_flow_statement`
INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
WHERE
    OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$compcode'
ORDER BY
    OrgCashFlowStatement_DATE_ADD
DESC
     ";
                                                $view_query = mysqli_query($con,$query);
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $desc = $row["DESCRIPTION"];
                                                    $id = $row["OrgCashFlowStatement_ID"];
                                                    $ref = $row["REF"];
                                                    $col = $row["COLLECTION"];
                                                    $exp = $row["EXPENSES"];
                                                    $bal = $row["BALANCE"];
                                                    $rem = $row["REMARKS"];
                                                    $dat = $row["DATEISSUED"];
                                                    
                                                    echo '
                                                    <tr>
                                                            <td class="hidden">'.$id.'</td>
                                                            <td>'.$ref.'</td>
                                                            <td>'.$desc.'</td>
                                                            <td>'.$col.'</td>
                                                            <td>'.$exp.'</td>
                                                            <td>'.$bal.'</td>
                                                            <td>'.$rem.'</td>
                                                            <td>'.$dat.'</td>
                                                    </tr>
                                                    ';
                                                    
                                                }


                                                ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="hidden">Reference</th>
                                                <th >Reference</th>
                                                <th>Description</th>
                                                <th>Collection</th>
                                                <th>Expense</th>
                                                <th>Balance</th>
                                                <th>Remarks</th>
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
    <script src="Organization/Cashflow.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#btnprint').click(function() {
                var items = [];
                var table = $('#editable-sample').DataTable();
                jQuery(table.fnGetNodes()).each(function() {
                    items.push($(this).closest('tr').children('td:first').text());
                });
                window.open('Print/CashflowStatement_Print.php?items=' + items, '_blank');
            });
//            alert("'<?php echo $compcode; ?>'");

        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
