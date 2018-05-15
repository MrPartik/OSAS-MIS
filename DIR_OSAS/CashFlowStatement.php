<!DOCTYPE html>
<html>
<title>OSAS - Cashflow Statement</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Cashflow Statement</a></li> </ul></div>";
$currentPage ='OSAS_Cflow';
include('header.php');   

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
                                <header class="panel-heading"> Cashflow Statement <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <select class="form-control m-bot15" id="drporg">
                                                    <option selected disabled>Please Select an Organization</option>
                                                    <?php 
                                                            $view_query = mysqli_query($con,"SELECT  OrgAppProfile_APPL_CODE, OrgAppProfile_NAME FROM  r_org_applicant_profile  ");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $code = $row["OrgAppProfile_APPL_CODE"];
                                                                $name = $row["OrgAppProfile_NAME"];
                                                                echo '<option value="'.$code.'">' .$name.'</option>';
                                                            }


                                                        ?>
                                                </select>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                            </div>
                                        </div>

                                        <div class="space15"></div>
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
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

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Reference</th>
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

        <?php include ('footer.php'); ?>
        <!--script for this page only-->
        <script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="../js/bootstrap-daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="Organization/Cashflow.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>
            $(document).ready(function() {
                $('#dateFrom').attr('disabled',true)
                $('#dateTo').attr('disabled',true)


                $('#btnprint').click(function() {
                    var items = [];
                    var table = $('#editable-sample').DataTable();
                    jQuery(table.fnGetNodes()).each(function() {
                        items.push($(this).closest('tr').children('td:first').find('label').attr("cashid"));
                    });
                    window.open('Print/CashflowStatement_Print.php?items=' + items, '_blank');
                });



            });
            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

    </body>

</html>
