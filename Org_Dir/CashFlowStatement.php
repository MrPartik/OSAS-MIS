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
$id = $referenced_user; 
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
                                                <option selected disabled>Please Select What to Show?</option> 
                                                <option value="<?php echo $id ?>">All</option>
                                                 <option value="<?php echo $id ?>" >Only my Cash Flow Statement ( <?php echo $id ?> )</option>  
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

<?php include('footer.php'); ?>
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

        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
