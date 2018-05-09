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
                        <div class="mini-stat-info"> <span><?php echo $count_registered_org ?></span> Registered Organization </div>
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
                        <div class="mini-stat-info"> <span><?php echo $count_pending_acc ?></span> Organization/s who is peding for accreditation </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa fa-paperclip"></i></span>
                        <div class="mini-stat-info"> <span><?php echo $count_finan_ass?></span>Number of Student who has financial assistance</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-envelope"></i></span>
                        <div class="mini-stat-info"> <span>100</span> Number of Archived Documents </div>
                    </div>
                </div>
                <!-- <div class="col-md-4">
        <div class="profile-nav alt">
            <section class="panel">
                <div class="user-heading alt clock-row terques-bg">
                    <h1><?php echo date('M')?></h1>
                    <p class="text-left"><?php echo date('Y, D')?></p>
                    <p class="text-left"><?php echo date('h:i A')?></p>
                </div>
                <ul id="clock">
                    <li id="sec"></li>
                    <li id="hour"></li>
                    <li id="min"></li>
                </ul>

                
            </section>

        </div> -->
        <center>
    </div><div class="col-md-12" >
        <div class="event-calendar clearfix">
            <div class="col-lg-7 calendar-block">
                <div class="cal1 ">
                </div>
            </div>
            <div class="col-lg-5 event-list-block">
                <div class="cal-day">
                    <span>Today</span>
                    <?php echo date('D')?>
                </div>
                <ul class="event-list">
                    <?php $sanc_query = mysqli_query($con,"SELECT A.AssSancStudStudent_STUD_NO StudNo, CONCAT(B.Stud_LNAME,', ',B.Stud_FNAME,' ',COALESCE(B.Stud_MNAME,'')) AS FullName, A.AssSancStudStudent_SancDetails_CODE  AS SANC, ((C.SancDetails_TIMEVAL)-(A.AssSancStudStudent_CONSUMED_HOURS)) as remaining FROM t_assign_stud_saction A 
INNER JOIN  r_stud_profile B on a.AssSancStudStudent_STUD_NO = a.AssSancStudStudent_STUD_NO
INNER JOIN r_sanction_details C on A.AssSancStudStudent_SancDetails_CODE = C.SancDetails_CODE
WHERE A.AssSancStudStudent_TO_BE_DONE = CURRENT_DATE AND A.AssSancStudStudent_STUD_NO = B.Stud_NO AND a.AssSancStudStudent_DISPLAY_STAT='Active' AND A.AssSancStudStudent_IS_FINISH <> 'Finish' AND a.AssSancStudStudent_CONSUMED_HOURS<>c.SancDetails_TIMEVAL");
                    while($row=mysqli_fetch_assoc($sanc_query)){ ?>
                
                <li><?php echo '<strong>'.$row["StudNo"].'</strong> <br> '.$row["FullName"].'<br> Sanction: '.$row["SANC"]."<br>Remaining Hours:".$row["remaining"]."hrs<br><i style='color:red'> Exceeding the sanction duedate</i>" ?><a id="StudSanctionModalClick" value="<?php echo $row["StudNo"]; ?>" data-toggle="modal" href="#studSanction" class="event-close"><i class="fa fa-bolt"></i></a></li>
                   
                    <?php }?>

                </ul>
            </div>
        </div>
    </div>
                <div class="col-md-6" style="padding-top:10px">
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
                <div class="col-md-6" style="padding-top:10px">
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
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="Vouch" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </section>
                </div>                
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div id="Remittance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4">
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
    
    <div id="studSanction" class="modal fade content-sanction " role="dialog "> </div>
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
    $("#StudSanctionModalClick ").on("click ", function () {
        var datas = $(this).attr("value");
        $.ajax({
            url: "studSanctionModal.php?StudNo=" + datas
            , cache: false
            , async: false
            , success: function (result) {
                $(".content-sanction ").html(result);
            }
        });
    });
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
            var series_array2 = [];
            var drilldown_array = [];
            var drilldown_array2 = [];
            var fdrilldown_array = [];
            $.ajax({
                type: "GET",
                url: 'Dashboard/Remittance_Series.php',
                dataType: 'json',
                success: function(data) {
                    var i = 0;


                    $.each(data, function(key, val) {
                        series_array.push({
                            name: val.name,
                            y: parseFloat(val.buo),
                            drilldown: val.orgcode
                        });

                        var drilldown = {};
                        drilldown.id = val.orgcode;
                        drilldown.name = val.name;
                        drilldown.data = [];

                        $.each(val.data, function(key2, val2) {
                            drilldown.data.push([val2.text, parseFloat(val2.pamount)]);
                            //                            drilldown_user.data.push([123]);
                            //alert(val2.amount)
                        });


                        drilldown_array.push(drilldown);


                    });
                    Highcharts.chart('Remittance', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Remittance'
                        },
                        subtitle: {
                            text: 'Remittance per Organization'
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

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>₱{point.y:,.2f}</b> Remit <br/>'
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

            var finalObj;
            var thirdObj;
            $.ajax({
                type: "GET",
                url: 'Dashboard/Event.php',
                dataType: 'json',
                success: function(data) {
                    var i = 0;
                    $.each(data, function(key, val) {
                            series_array2.push({
                                name: val.name,
                                y: parseFloat(val.cat),
                                drilldown: val.name
                        });  
                        var drilldown = {};
                        drilldown.id = val.name;
                        drilldown.name = val.name ;
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
                                name: val2.vouch + ' - ' + val2.orgname,
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
                                drilldown2.data = drilldown2.data.concat(data3);
                                //alert(getlatid)
                                fdrilldown_array.push(drilldown2);
                                
                                drilldown2 = {};
                                drilldown2.id = '';
                                drilldown2.data = [];

                                
                            });
                                            
                        });
                        
                        drilldown_array2.push(drilldown);
                        
                    }); 
                    
                    finalObj = drilldown_array2.concat(fdrilldown_array);
                    
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
                        "data": series_array2
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
            


        });

    </script>

</body>
