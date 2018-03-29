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
include('../config/connection.php');     

?>
<link rel="stylesheet" href="../js/morris-chart/morris.css">

<body>
    <!--sidebar start-->
    <?php include('sidenav.php')?>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <!-- <div class="col-md-12">
                            <ul class="breadcrumbs-alt" style="position">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a href="dashboard.php" class="current">Dashboard</a> </li>
                            </ul>
                        </div> -->
                <div class="col-md-6">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                        <div class="mini-stat-info"> <span> <?php echo $current_acadyear;?></span> Activated Academic Year </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                        <div class="mini-stat-info"> <span><?php echo $current_semster;?></span> Activated Semester </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-user"></i></span>
                        <div class="mini-stat-info"> <span><?php echo $count_stud; ?></span> Number of Students </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-users"></i></span>
                        <div class="mini-stat-info"> <span>450</span> Registered Organization </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
                        <div class="mini-stat-info"> <span>5</span> Organization Fund Request </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-asterisk"></i></span>
                        <div class="mini-stat-info"> <span>10</span> Number of Student who lost their Regicard or ID </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-user"></i></span>
                        <div class="mini-stat-info"> <span> <?php echo $count_stud_sanction?></span> Number of Students who has sanction/s </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-users"></i></span>
                        <div class="mini-stat-info"> <span>20</span> Organization/s who is peding for accreditation </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa fa-paperclip"></i></span>
                        <div class="mini-stat-info"> <span>0</span>Number of Student who has financial assistance</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-envelope"></i></span>
                        <div class="mini-stat-info"> <span>100</span> Number of Archived Documents </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="sanctions" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            <table id="tblSanction">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <?php
                                            $view_query = mysqli_query($con," SELECT Course_CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active' ORDER BY (SELECT COUNT(DISTINCT LogSanc_AssSancSudent_ID) AS COU FROM `log_sanction` 
                                                INNER JOIN t_assign_stud_saction ON AssSancStudStudent_ID = LogSanc_AssSancSudent_ID
                                                INNER JOIN r_stud_profile ON AssSancStudStudent_STUD_NO = Stud_NO
                                                     WHERE LogSanc_IS_FINISH = 'Processing' AND Stud_COURSE = Course_CODE) DESC");
                                            while($row = mysqli_fetch_assoc($view_query))
                                            {
                                                $legend = $row["Course_CODE"];

                                                echo "
                                                <th>$legend</th>
                                                    ";
                                            }

                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Sanction</th>
                                        <?php
                                            $view_query = mysqli_query($con," SELECT Course_CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active' ORDER BY (SELECT COUNT(DISTINCT LogSanc_AssSancSudent_ID) AS COU FROM `log_sanction` 
                                                INNER JOIN t_assign_stud_saction ON AssSancStudStudent_ID = LogSanc_AssSancSudent_ID
                                                INNER JOIN r_stud_profile ON AssSancStudStudent_STUD_NO = Stud_NO
                                                     WHERE LogSanc_IS_FINISH = 'Processing' AND Stud_COURSE = Course_CODE) DESC");
                                            while($row = mysqli_fetch_assoc($view_query))
                                            {
                                                $legend = $row["Course_CODE"];

                                            
                                                $view_query2 = mysqli_query($con," SELECT COUNT(DISTINCT LogSanc_AssSancSudent_ID) AS COU FROM `log_sanction` 
                                                INNER JOIN t_assign_stud_saction ON AssSancStudStudent_ID = LogSanc_AssSancSudent_ID
                                                INNER JOIN r_stud_profile ON AssSancStudStudent_STUD_NO = Stud_NO
                                                     WHERE LogSanc_IS_FINISH = 'Processing' AND Stud_COURSE = '$legend' ");
                                                while($row2 = mysqli_fetch_assoc($view_query2))
                                                {
                                                    $item = $row2["COU"];

                                                    echo "
                                                    <td>$item</td>
                                                    ";


                                                }
                                            }

                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="col-md-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="FinancialAssistance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            <table id="tblFinAss">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <?php
                                            $view_query = mysqli_query($con," SELECT FinAssiTitle_NAME FROM `r_financial_assistance_title` WHERE FinAssiTitle_DISPLAY_STAT = 'Active' ");
                                            while($row = mysqli_fetch_assoc($view_query))
                                            {
                                                $legend = $row["FinAssiTitle_NAME"];

                                                echo "
                                                <th>$legend</th>
                                                    ";
                                            }

                                        ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th>Financial Assistance</th>
                                        <?php
                                            $view_query = mysqli_query($con," SELECT FinAssiTitle_NAME FROM `r_financial_assistance_title` WHERE FinAssiTitle_DISPLAY_STAT = 'Active' ");
                                            while($row = mysqli_fetch_assoc($view_query))
                                            {
                                                $legend = $row["FinAssiTitle_NAME"];

                                            
                                                $view_query2 = mysqli_query($con," SELECT COUNT(*) as COU FROM `t_assign_stud_finan_assistance`                                               
                                                WHERE AssStudFinanAssistance_FINAN_NAME = '$legend' AND AssStudFinanAssistance_STATUS = 'Active' ");
                                                while($row2 = mysqli_fetch_assoc($view_query2))
                                                {
                                                    $item = $row2["COU"];

                                                    echo "
                                                    <td>$item</td>
                                                    ";


                                                }
                                            }

                                        ?>
                                    </tr>



                                </tbody>
                            </table>

                        </div>
                    </section>
                </div>
                <div class="col-md-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="Remittance" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="graph-donut"></div>
                        </div>
                    </section>
                </div>

            </div>
        </section>
    </section>
    <!--main content end-->
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <?php include('footer.php')?>
    <script src="../js/morris-chart/morris.js"></script>
    <script src="../js/morris-chart/raphael-min.js"></script>
    <script src="../js/highcharts.js"></script>
    <script src="../js/data.js"></script>
    <script src="../js/drilldown.js"></script>
    <script src="../js/exporting.js"></script>
    <script src="Dashboard/donut-graph.js"></script>
    <!-- Easy Pie Chart-->
    <script src="../js/easypiechart/jquery.easypiechart.js"></script>
    <!-- Sparkline Chart-->
    <script src="../js/sparkline/jquery.sparkline.js"></script>
    <!-- jQuery Flot Chart-->


    <script>
        $(document).ready(function() {
            $('#tblSanction').hide();
            $('#tblFinAss').hide();

            Highcharts.chart('sanctions', {
                data: {
                    table: 'tblSanction'
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Sanction Bar Graph'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Number of Sanction'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                }
            });

            Highcharts.chart('FinancialAssistance', {
                data: {
                    table: 'tblFinAss'
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Financial Assistance Bar Graph'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Number of Financial Assistance'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                }
            });

            // Create the chart

            var series_array = [];
            var drilldown_array = [];
            $.ajax({
                type: "GET",
                url: 'Dashboard/Remittance_Series.php',
                dataType: 'json',
                success: function(data) {
                    var i = 0;


                    $.each(data, function(key, val) {
                        series_array.push({
                            name: val.name,
                            y: parseFloat(val.percent),
                            drilldown: val.orgcode
                        });

                        var drilldown = {};
                        drilldown.id = val.orgcode;
                        drilldown.name = val.name;
                        drilldown.data = [];

                        $.each(val.data, function(key2, val2) {
                            drilldown.data.push([val2.text, parseFloat(val2.per)]);
                            //                            drilldown_user.data.push([123]);
                            //alert(val2.amount)
                        });


                        drilldown_array.push(drilldown);


                    });
                    Highcharts.chart('Remittance', {
                        chart: {
                            type: 'pie'
                        },
                        plotOptions: {
                            series: {
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: {point.y:.1f}%'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                        },

                        "series": [{
                            "name": "Organization",
                            "colorByPoint": true,
                            "data": series_array
                        }],
                        "drilldown": {
                            "series": drilldown_array
                        }
                    });


                },
                error: function(response) {
                    swal("Error encountered while adding data", "Please try again", "error");
                }

            });


        });

    </script>

</body>
