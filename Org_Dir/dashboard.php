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
                <div class="row">
                        <div class="col-lg-8">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="event-calendar clearfix">
                                        <div class="col-lg-7 calendar-block">
                                            <div class="cal1 ">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 event-list-block">
                                            <div class="cal-day">
                                                <span>Today</span>
                                                <?php echo date("l");?>
                                            </div>
                                            <ul class="event-list">

                                                <?php
                                                    $view_query = mysqli_query($con,"SELECT OrgEvent_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') as PROPDATE FROM r_org_event_management WHERE CURRENT_DATE < OrgEvent_PROPOSED_DATE AND OrgEvent_OrgCode = '$user_check' AND OrgEvent_STATUS = 'Approved' ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $name = $row["OrgEvent_NAME"];
                                                        $date = $row["PROPDATE"];

                                                        echo '
                                                            <li>'.$name.' @ ' .$date .' </li>

                                                             ';
                                                    }

                                               ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="panel">
                                <div class="panel-body">
                                    <div id="Vouch" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                </div>
                            </section>
                        </div>
                            <div class="col-lg-4">
                                <section class="panel">
                                    <div class="panel-body">
                                        <h3 class="prf-border-head">Population</h3>
                                        <div id="fillpopulation"></div>
                                    </div>
                                </section>
                                <section class="panel">
                                    <div class="panel-body">
                                        <div id="graph-donut"></div>
                                    </div>
                                </section>
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="prf-box">
                                            <h3 class="prf-border-head">Organization Officer</h3>
                                            <div id="fillmembers">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
        </section>

    </section>
    <?php  include('../config/NotificationRemittanceApproval.php') ?>

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
    <script src="../js/data.js"></script>
    <script src="../js/export-data.js"></script>
    <script src="../js/drilldown.js"></script>

    <script>
        $(document).ready(function() {
            var series_array = [];
            var drilldown_array = [];
            var fdrilldown_array = [];
            //event
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
            var finalObj;
            var thirdObj;
            $.ajax({
                type: "GET",
                url: 'Dashboard/Event.php',
                dataType: 'json',
                success: function(data) {
                    var i = 0;
                    $.each(data, function(key, val) {
                            series_array.push({
                                name: val.name,
                                y: parseFloat(val.cat),
                                drilldown: val.name
                        });
                        var drilldown = {};
                        drilldown.id = val.name;
                        drilldown.name = val.name;
                        drilldown.data = [];

                        var series = [];


                        var drilldown2 = {};
                        drilldown2.id = '';
                        drilldown2.data = [];

                        var data3 = [];

                        $.each(val.data, function(key2, val2) {
                            series.push({
                                name: val2.vouch,
                                y: parseFloat(val2.amount),
                                drilldown: val2.vouch
                            });
                            //drilldown.data.push({series});
                            drilldown.data.push({
                                name: val2.vouch,
                                y: parseFloat(val2.amount),
                                drilldown: val2.vouch
                            });

//                            $.each(val2.data2, function(key3, val3) {
//                                drilldown2.id = val3.vouchname;
//                                drilldown2.data.push([parseFloat(val3.itemamount)]);
//                                alert(val3.itemamount + val3.vouchname)
//
//                            });
                            var getlatid = '';
                            $.each(val2, function(key3, val3) {
                                data3 = [];
                                $.each(val2.data2, function(key4, val4) {
                                    data3.push({name:val4.itemname,y:parseFloat(val4.itemamount)} );
                                    getlatid = val4.vouchname;
    //                               alert(val4.itemamount + val4.itemname)

                                });
                                drilldown2.id = getlatid;
                                drilldown2.name = 'Voucher Item';
                                drilldown2.data = drilldown2.data.concat(data3);
                                //alert(getlatid)
                                fdrilldown_array.push(drilldown2);

                                drilldown2 = {};
                                drilldown2.id = '';
                                drilldown2.data = [];


                            });

                        });

                        drilldown_array.push(drilldown);

                    });

                    finalObj = drilldown_array.concat(fdrilldown_array);

                    Highcharts.chart('Vouch', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Vouch History'
                },
                subtitle: {
                    text: 'Money Used per Year'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total percent market share'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:,.2f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>₱{point.y:,.2f}</b> of total money used<br/>'
                },

                "series": [
                    {
                        "name": "Year of",
                        "colorByPoint": true,
                        "data": series_array
                    }
                ],
                "drilldown": {
                    "series": finalObj
                }
//                drilldown: {
//                    series: [{
//                        id: '2018',
//                        name: 'Animals',
//                        data: [{
//                            name: 'Vouch #0001',
//                            y: 4,
//                            drilldown: 'Vouch #0001'
//                        },{
//                            name: 'Vouch #0004',
//                            y: 4,
//                            drilldown: 'Vouch #0004'
//                        }, ['Dogs', 2],
//                            ['Cows', 1],
//                            ['Sheep', 2],
//                            ['Pigs', 1]
//                        ]
//                    }, {
//
//                        id: 'Vouch #0001',
//                        data: [{id: 'er',y:  1, name:'esr'}]
//                    }
//                    ]
//                }

            });


                }
            });
            var vouch_array = [];




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
