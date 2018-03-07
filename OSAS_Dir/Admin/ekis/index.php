<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Editable Table</title>

    <!--Core CSS -->
    <link href="../../bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-reset.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/style-responsive.css" rel="stylesheet" />
    <link href="../sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">

    <link href="../../js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="../../js/morris-chart/morris.css">
    <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/style-responsive.css" rel="stylesheet" />
    <!--clock css-->
    <link href="../../js/css3clock/css/style.css" rel="stylesheet">
    <!--calendar css-->
    <link href="../../css/clndr.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">

                <a href="dashboard.php" class="logo"> 
        <img src="../images/logo.png" alt=""> 
    </a>

                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="../images/OSAS/zxc.png">
                <span class="username">Eric Valdez</span>
                <b class="caret"></b>
            </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="../login.php"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Student Setup</span>
                    </a>
                            <ul class="sub">
                                <li><a href="../StudentSetup/FinancialAssistanceTitle.php">Assistance Title</a></li>
                                <li><a href="../StudentSetup/BatchYear.php">Batch Year</a></li>
                                <li><a href="../StudentSetup/Semester.php">Semester</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Organization Setup</span>
                    </a>
                            <ul class="sub">
                                <li><a href="../OrganizationSetup/AccreditationRequirement.php">Accreditation Requirement</a></li>
                                <li><a href="../OrganizationSetup/Course.php">Course</a></li>
                                <li><a href="../OrganizationSetup/OrganizationCategory.php">Organization Category</a></li>
                                <li><a href="../OrganizationSetup/OfficerPosition.php">Officer Position</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Sanction Setup</span>
                    </a>
                            <ul class="sub">
                                <li><a href="../SanctionSetup/ClearanceSignatory.php">Clearance Signatory</a></li>
                                <li><a href="../SanctionSetup/DesignatedOffice.php">Designated Office</a></li>
                                <li><a href="../SanctionSetup/SanctionDetail.php">Sanction Detail</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="admin-login" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-               default" type="button">Cancel</button>
                        <button class="btn btn-success" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->




        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="profile-nav alt">
                            <section class="panel">
                                <div class="user-heading alt clock-row " style="background-color:#E40D39">
                                    <h1>December 14</h1>
                                    <p class="text-left">2014, Friday</p>
                                    <p class="text-left">7:53 PM</p>
                                </div>
                                <ul id="clock">
                                    <li id="sec" style="transform: rotate(198deg);"></li>
                                    <li id="hour" style="transform: rotate(709deg);"></li>
                                    <li id="min" style="transform: rotate(228deg);"></li>
                                </ul>


                            </section>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="top-stats-panel">
                                <div class="gauge-canvas">
                                    <h4 class="widget-h">Monthly Expense</h4>
                                    <canvas width="160" height="100" id="gauge"></canvas>
                                </div>
                                <ul class="gauge-meta clearfix">
                                    <li id="gauge-textfield" class="pull-left gauge-value">1,150</li>
                                    <li class="pull-right gauge-title">Safe</li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <section class="panel text-center">
                            <div class="profile-nav alt">
                                <section class="panel text-center">
                                    <div class="user-heading alt wdgt-row" style="background-color:#E40D39">
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <div class="panel-body" style="background-color:white">
                                        <div class="wdgt-value">
                                            <h1 class="count" style="color:#E40D39">19</h1>
                                            <p style="color:#E40D39">Active System Account</p>
                                        </div>
                                    </div>

                                </section>
                            </div>
                            <div class="weather-category twt-category">
                                <ul>
                                    <li class=" ">
                                        <font color="#E40D39" style="font-size:150%;color:#E40D39">System Admin</font>
                                        <br/>
                                        <font color="#E40D39" style="font-size:120%;color:#E40D39">5</font>
                                    </li>
                                    <li>
                                        <font color="#E40D39" style="font-size:150%;color:#E40D39">OSAS Head</font>
                                        <br/>
                                        <font color="#E40D39" style="font-size:120%;color:#E40D39">1</font>
                                    </li>
                                    <li>
                                        <font color="#E40D39" style="font-size:150%;color:#E40D39">Organization</font>
                                        <br/>
                                        <font color="#E40D39" style="font-size:120%;color:#E40D39">13</font>
                                    </li>
                                </ul>
                            </div>


                        </section>
                    </div>

                </div>
                <div class="row" style="padding-top:10px">

                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon " style="background-color:#E40D39"><i class="fa fa-group"></i></span>
                            <div class="mini-stat-info">
                                <span>5</span> Accreditation Requirement
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-asterisk"></i></span>
                            <div class="mini-stat-info">
                                <span>9</span> Assistance Title
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-gavel"></i></span>
                            <div class="mini-stat-info">
                                <span>15</span> Course
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-location-arrow"></i></span>
                            <div class="mini-stat-info">
                                <span>10</span> Clearance Signatory
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon " style="background-color:#E40D39"><i class="fa fa-group"></i></span>
                            <div class="mini-stat-info">
                                <span>5</span> Designated Offices
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-asterisk"></i></span>
                            <div class="mini-stat-info">
                                <span>9</span> Organization Category
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-gavel"></i></span>
                            <div class="mini-stat-info">
                                <span>15</span> Sanction
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stat clearfix">
                            <span class="mini-stat-icon" style="background-color:#E40D39"><i class="fa fa-location-arrow"></i></span>
                            <div class="mini-stat-info">
                                <span>10</span> Semester
                            </div>
                        </div>
                    </div>
                </div>

                <!-- page end-->

            </section>
            <!-- Modal -->

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

        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="../../bs3/js/bootstrap.min.js"></script>
        <script src="../../js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../../js/jquery.scrollTo.min.js"></script>
        <script src="../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <script src="../../js/jquery.nicescroll.js"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src="../../js/skycons/skycons.js"></script>
        <script src="../../js/jquery.scrollTo/jquery.scrollTo.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="../../js/calendar/clndr.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
        <script src="../../js/calendar/moment-2.2.1.js"></script>
        <script src="../../js/evnt.calendar.init.js"></script>
        <script src="../../js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../../js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
        <script src="../../js/gauge/gauge.js"></script>
        <!--clock init-->
        <script src="../../js/css3clock/js/css3clock.js"></script>
        <!--Easy Pie Chart-->
        <script src="../../js/easypiechart/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <script src="../../js/sparkline/jquery.sparkline.js"></script>
        <!--Morris Chart-->
        <script src="../../js/morris-chart/raphael-min.js"></script>
        <!--jQuery Flot Chart-->
        <script src="../../js/dashboard.js"></script>
        <script src="../../js/jquery.customSelect.min.js"></script>
        <!--common script init for all pages-->
        <script src="../../js/scripts.js"></script>
        <!--Easy Pie Chart-->
        <script src="../../js/easypiechart/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <script src="../../js/sparkline/jquery.sparkline.js"></script>

        <script type="text/javascript" src="../../js/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="../sweetalert/sweetalert.min.js"></script>

        <!-- chartist -->
        <script type="text/javascript" src="../../js/plugins/chartist-js/chartist.min.js"></script>

        <!-- chartjs -->
        <script type="text/javascript" src="../../js/plugins/chartjs/chart.min.js"></script>
        <script type="text/javascript" src="../../js/plugins/chartjs/chart-script.js"></script>

        <!-- sparkline -->
        <script type="text/javascript" src="../../js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="../../js/plugins/sparkline/sparkline-script.js"></script>
        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="../../js/plugins.min.js"></script>

        <!--common script init for all pages-->
        <script src="../../js/scripts.js"></script>

        <!--script for this page only-->


</body>

</html>
