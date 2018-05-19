<!DOCTYPE html>
<html>
<title>OSAS - Student Sanction</title>
<?php
$breadcrumbs ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href=#'>Configuration and Maintenance</a> </li>
    <li> <a class='current' href='studSanction.php'>System Configuration</a> </li>
</ul>
</div>";
$currentPage ='Config';
include('header.php');
include('../config/connection.php');
?>

    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-calendar"></i></span>
                                <div class="mini-stat-info"> <span><?php $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `r_system_config` WHERE `SysConfig_NAME` = 'DisposalDays'")); echo $row["SysConfig_PROPERTIES"]?></span>Disposal of Documents (Limitation in (Day/s))</div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Sanction Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div id="TableStudSanc" class="panel-body">
                                    <div class="adv-table">
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Configuration Name</th>
                                                    <th>Configuration Propery</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $view_query = mysqli_query($con,"SELECT `SysConfig_NAME`,`SysConfig_PROPERTIES`,`SysConfig_DATE_ADD`,`SysConfig_DATE_MOD`,`SysConfig_DISPLAY_STAT` FROM `r_system_config` ");
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $name = $row["SysConfig_NAME"];
                                                    $prop = $row["SysConfig_PROPERTIES"];
                                                    $date = $row["SysConfig_DATE_MOD"];
                                                    $stat = $row["SysConfig_DISPLAY_STAT"];


                                                    echo "
                                                    <tr class=''>
                                                        <td>$name</td>
                                                        <td>$prop</td>
                                                        <td >".(new datetime($date))->format('D M d, Y h:i A')."</td>

                                                                <td style='width:180px'>
                                                                    <center>
                                                                        <a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a>
                                                                    <center>
                                                                </td>

                                                            </tr>
                                                            ";}

    									   ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Configuration Name</th>
                                                    <th>Configuration Propery</th>
                                                    <th>Last Modified</th>
                                                    <th>
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
                </section>
            </section>
    </body>

</html>
<script src="../ASSETS/js/jquery-1.8.3.min.js"></script>
<script src="../ASSETS/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
<script src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
<script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="../ASSETS/js/jquery.nicescroll.js">
    < script src = "../ASSETS/js/skycons/skycons.js" >
</script>
<script src="../ASSETS/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="../ASSETS/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="../ASSETS/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script src="../ASSETS/js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="../ASSETS/js/calendar/moment-2.2.1.js"></script>
<script src="../ASSETS/js/evnt.calendar.init.js"></script>
<script src="../ASSETS/js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../ASSETS/js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="../ASSETS/js/select2/select2.js"></script>
<script src="../ASSETS/js/select-init.js"></script>
<script src="../ASSETS/js/gauge/gauge.js"></script>
<!--clock init-->
<script src="../ASSETS/js/css3clock/js/css3clock.js"></script>
<!--Easy Pie Chart-->
<script src="../ASSETS/js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="../ASSETS/js/sparkline/jquery.sparkline.js"></script>
<script src="../ASSETS/js/jquery.customSelect.min.js"></script>
<!--sweet alert -->
<script src="../ASSETS/js/sweetalert/sweetalert-dev.js"></script>
<script type="text/javascript" src="../ASSETS/js/sweetalert/sweetalert.min.js"></script>
<!--common script init for all pages-->
<script src="../ASSETS/js/scripts.js"></script>
<!--script for this page-->
<script type="text/javascript" src="../ASSETS/js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
<script src="SystemConfig/systemConfig.js"></script>
<script>
    EditableTable.init();
</script>
