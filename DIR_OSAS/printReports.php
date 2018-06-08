<!DOCTYPE html>
<html>
<title>OSAS - Print Reports</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
     <li> <a  href='#'>Reports</a>  </li>
<li><a class='current'' href='printReports.php'>Print</a></li> </ul></div>";
$currentPage ='OSAS_print';
include ('header.php');
?>

    <body>
        <section id="container">
            <!--header end-->
            <aside>
                <div id="sidebar" class="nav-collapse">
                    <!-- sidebar menu start-->
                    <?php include('sidenav.php') ?>
                        <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row" id="tableForm">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading"> <i class="fa fa-user"></i> Print Student Sanction <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class=""> asd </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading"> <i class="fa fa-money"></i> Print Student Financial Assistance <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class=""> asd </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading"> <i class="fa fa-asterisk"></i> Print Loss of ID and Regi Card <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class=""> asd </div>
                                </div>
                            </section>
                        </div>
                    </div> <a class='btn btn-cancel tar edit hidden' style='color:white' data-toggle='modal' id="openModalupd" href='#Edit' href='javascript:;'>Profile</a>
                    <!-- page end-->
                </section>
            </section>
        </section>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <!--Core js-->
        <?php include("footer.php"); ?>
            <!--script for this page only-->
    </body>

</html>
<script
</script>
