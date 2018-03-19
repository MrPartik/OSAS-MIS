<!DOCTYPE html>
<title>OSAS - Dashboard</title>
<?php 
$currentPage ='OSAS_Dashboard';
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt' style='position'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='dashboard.php' class='current'>Dashboard</a> </li>
</ul>
</div>";
include('header.php'); 
$compcode = $referenced_user;
include('../config/connection.php');     

?>
<!--Morris Chart CSS -->
<link rel="stylesheet" href="../js/morris-chart/morris.css">


<body>
    <!--sidebar start-->
    <?php include('sidenav.php')?>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Dashboard
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                    </header>
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <h3 class="prf-border-head">Population</h3>
                                <div id="fillpopulation"></div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <div id="graph-donut"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel-body">
                                <div class="prf-box">
                                    <h3 class="prf-border-head">Organization Officer</h3>
                                    <div id="fillmembers">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <!--main content end-->
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <?php include('footer.php')?>
    <!--Morris Chart-->
    <script src="../js/morris-chart/morris.js"></script>
    <script src="../js/morris-chart/raphael-min.js"></script>
    <script src="Dashboard/donut-graph.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: 'Dashboard/Officer.php',
                data: {
                    _appcode:'<?php echo $compcode?>'
                },
                success: function(data) { 
                    document.getElementById('fillmembers').innerHTML = data;

                },
                error: function(response) {
                    swal("Error encountered while adding data", "Please try again", "error");
                }

            });
            $.ajax({
                type: "GET",
                url: 'Dashboard/Population.php',
                data: {
                    _appcode:'<?php echo $compcode?>'
                },
                success: function(data) {
                    //alert(data)
                    document.getElementById('fillpopulation').innerHTML = data;

                },
                error: function(response) {
                    swal("Error encountered while adding data", "Please try again", "error");
                }

            });


        });

    </script>
</body>
