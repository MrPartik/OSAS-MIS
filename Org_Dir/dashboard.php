<!DOCTYPE html>
<title>OSAS - Dashboard</title>
<?php 
$currentPage ='Org_Dashboard';
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
                        <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <h3 class="prf-border-head">Remittance</h3>
                                        <div id="graph-line"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
<!--
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div id="Remittance" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
-->
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
    <script src="Dashboard/Remitance-LineGraph.js"></script>
    <script src="../js/highcharts.js"></script>
    <script src="../js/data.js"></script>
    <script src="../js/drilldown.js"></script>

    <script>
        $(document).ready(function() {
            var series_array = [];
            var drilldown_array = [];
//            $.ajax({
//                type: "GET",
//                url: 'Dashboard/Remittance_Series.php',
//                dataType: 'json',
//                success: function(data) {
//                    var i = 0;
//
//
//                    $.each(data, function(key, val) {
//                        series_array.push({
//                            name: val.name,
//                            y: parseFloat(val.percent),
//                            drilldown: val.orgcode
//                        });
//
//                        var drilldown = {};
//                        drilldown.id = val.orgcode;
//                        drilldown.name = val.name;
//                        drilldown.data = [];
//
//                        $.each(val.data, function(key2, val2) {
//                            drilldown.data.push([val2.text, parseFloat(val2.per)]);
//                            //                            drilldown_user.data.push([123]);
//                            //alert(val2.amount)
//                        });
//
//
//                        drilldown_array.push(drilldown);
//
//
//                    });
//                    Highcharts.chart('Remittance', {
//                        chart: {
//                            type: 'pie'
//                        },
//                        plotOptions: {
//                            series: {
//                                dataLabels: {
//                                    enabled: true,
//                                    format: '{point.name}: {point.y:.1f}%'
//                                }
//                            }
//                        },
//
//                        tooltip: {
//                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
//                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
//                        },
//
//                        "series": [{
//                            "name": "Organization",
//                            "colorByPoint": true,
//                            "data": series_array
//                        }],
//                        "drilldown": {
//                            "series": drilldown_array
//                        }
//                    });
//
//
//                },
//                error: function(response) {
//                    swal("Error encountered while adding data", "Please try again", "error");
//                }
//
//            });
            $.ajax({
                type: "GET",
                url: 'Dashboard/Officer.php',
                data: {
                    _appcode: '<?php echo $compcode?>'
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
                    _appcode: '<?php echo $compcode?>'
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
