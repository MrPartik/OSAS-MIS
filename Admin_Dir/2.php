<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="../images/favicon.png">
    <link href="../../bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-reset.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="../../css/clndr.css" rel="stylesheet">
    <link href="../../js/css3clock/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../js/morris-chart/morris.css">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/style-responsive.css" rel="stylesheet" />
    <link href="sweetalert/sweetalert.css" rel="stylesheet">
    <title>OSAS - Dashboard</title>
    <link href="../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/style-responsive.css" rel="stylesheet" />
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
                <img alt="" src="../images/OSAS/MAAM%20DEM.jpg">
                <span class="username">Demelyn E. Monzon</span>
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
                            <a href="index.html">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Layouts</span>
                </a>
                            <ul class="sub">
                                <li><a href="boxed_page.html">Boxed Page</a></li>
                                <li><a href="horizontal_menu.html">Horizontal Menu</a></li>
                                <li><a href="language_switch.html">Language Switch Bar</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>UI Elements</span>
                </a>
                            <ul class="sub">
                                <li><a href="general.html">General</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="widget.html">Widget</a></li>
                                <li><a href="slider.html">Slider</a></li>
                                <li><a href="tree_view.html">Tree View</a></li>
                                <li><a href="nestable.html">Nestable</a></li>
                                <li><a href="grids.html">Grids</a></li>
                                <li><a href="calendar.html">Calender</a></li>
                                <li><a href="draggable_portlet.html">Draggable Portlet</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="fontawesome.html">
                    <i class="fa fa-bullhorn"></i>
                    <span>Fontawesome </span>
                </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-th"></i>
                    <span>Data Tables</span>
                </a>
                            <ul class="sub">
                                <li><a href="basic_table.html">Basic Table</a></li>
                                <li><a href="responsive_table.html">Responsive Table</a></li>
                                <li><a href="dynamic_table.html">Dynamic Table</a></li>
                                <li><a href="editable_table.html">Editable Table</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-tasks"></i>
                    <span>Form Components</span>
                </a>
                            <ul class="sub">
                                <li><a href="form_component.html">Form Elements</a></li>
                                <li><a href="advanced_form.html">Advanced Components</a></li>
                                <li><a href="form_wizard.html">Form Wizard</a></li>
                                <li><a href="form_validation.html">Form Validation</a></li>
                                <li><a href="file_upload.html">Muliple File Upload</a></li>

                                <li><a href="dropzone.html">Dropzone</a></li>
                                <li><a href="inline_editor.html">Inline Editor</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>Mail </span>
                </a>
                            <ul class="sub">
                                <li><a href="mail.html">Inbox</a></li>
                                <li><a href="mail_compose.html">Compose Mail</a></li>
                                <li><a href="mail_view.html">View Mail</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;" class="active">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                </a>
                            <ul class="sub">
                                <li><a href="morris.html">Morris</a></li>
                                <li><a href="chartjs.html">Chartjs</a></li>
                                <li class="active"><a href="flot_chart.html">Flot Charts</a></li>
                                <li><a href="c3_chart.html">C3 Chart</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Maps</span>
                </a>
                            <ul class="sub">
                                <li><a href="google_map.html">Google Map</a></li>
                                <li><a href="vector_map.html">Vector Map</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                    <i class="fa fa-glass"></i>
                    <span>Extra</span>
                </a>
                            <ul class="sub">
                                <li><a href="blank.html">Blank Page</a></li>
                                <li><a href="lock_screen.html">Lock Screen</a></li>
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="pricing_table.html">Pricing Table</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="gallery.html">Media Gallery</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="500.html">500 Error</a></li>
                                <li><a href="registration.html">Registration</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="login.html">
                    <i class="fa fa-user"></i>
                    <span>Login Page</span>
                </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->

                <div class="row">
                    <div class="col-sm-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div id="pie-chart" class="pie-chart">
                                    <div id="pie-chartContainer" style="width: 100%;height:400px; text-align: left;">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

                <div class="panel-body">
                    <div id="visitors-chart">
                        <div id="visitors-container" style="width: 100%;height:300px; text-align: center; margin:0 auto;">
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="reatltime-chart">
                        <div id="reatltime-chartContainer" style="width:100%;height:300px; text-align: center; margin:0 auto;">
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <!--main content end-->
        <!--right sidebar start-->
        <div class="right-sidebar">
            <div class="search-row">
                <input type="text" placeholder="Search" class="form-control">
            </div>
            <div class="right-stat-bar">
                <ul class="right-side-accordion">
                    <li class="widget-collapsible">
                        <a href="#" class="head widget-head red-bg active clearfix">
        <span class="pull-left">work progress (5)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
                        <ul class="widget-container">
                            <li>
                                <div class="prog-row side-mini-stat clearfix">
                                    <div class="side-graph-info">
                                        <h4>Target sell</h4>
                                        <p>
                                            25%, Deadline 12 june 13
                                        </p>
                                    </div>
                                    <div class="side-mini-graph">
                                        <div class="target-sell">
                                        </div>
                                    </div>
                                </div>
                                <div class="prog-row side-mini-stat">
                                    <div class="side-graph-info">
                                        <h4>product delivery</h4>
                                        <p>
                                            55%, Deadline 12 june 13
                                        </p>
                                    </div>
                                    <div class="side-mini-graph">
                                        <div class="p-delivery">
                                            <div class="sparkline" data-type="bar" data-resize="true" data-height="30" data-width="90%" data-bar-color="#39b7ab" data-bar-width="5" data-data="[200,135,667,333,526,996,564,123,890,564,455]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="prog-row side-mini-stat">
                                    <div class="side-graph-info payment-info">
                                        <h4>payment collection</h4>
                                        <p>
                                            25%, Deadline 12 june 13
                                        </p>
                                    </div>
                                    <div class="side-mini-graph">
                                        <div class="p-collection">
                                            <span class="pc-epie-chart" data-percent="45">
						<span class="percent"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="prog-row side-mini-stat">
                                    <div class="side-graph-info">
                                        <h4>delivery pending</h4>
                                        <p>
                                            44%, Deadline 12 june 13
                                        </p>
                                    </div>
                                    <div class="side-mini-graph">
                                        <div class="d-pending">
                                        </div>
                                    </div>
                                </div>
                                <div class="prog-row side-mini-stat">
                                    <div class="col-md-12">
                                        <h4>total progress</h4>
                                        <p>
                                            50%, Deadline 12 june 13
                                        </p>
                                        <div class="progress progress-xs mtop10">
                                            <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                                                <span class="sr-only">50% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="widget-collapsible">
                        <a href="#" class="head widget-head terques-bg active clearfix">
        <span class="pull-left">contact online (5)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
                        <ul class="widget-container">
                            <li>
                                <div class="prog-row">
                                    <div class="user-thumb">
                                        <a href="#"><img src="images/avatar1_small.jpg" alt=""></a>
                                    </div>
                                    <div class="user-details">
                                        <h4><a href="#">Jonathan Smith</a></h4>
                                        <p>
                                            Work for fun
                                        </p>
                                    </div>
                                    <div class="user-status text-danger">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb">
                                        <a href="#"><img src="images/avatar1.jpg" alt=""></a>
                                    </div>
                                    <div class="user-details">
                                        <h4><a href="#">Anjelina Joe</a></h4>
                                        <p>
                                            Available
                                        </p>
                                    </div>
                                    <div class="user-status text-success">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb">
                                        <a href="#"><img src="images/chat-avatar2.jpg" alt=""></a>
                                    </div>
                                    <div class="user-details">
                                        <h4><a href="#">John Doe</a></h4>
                                        <p>
                                            Away from Desk
                                        </p>
                                    </div>
                                    <div class="user-status text-warning">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb">
                                        <a href="#"><img src="images/avatar1_small.jpg" alt=""></a>
                                    </div>
                                    <div class="user-details">
                                        <h4><a href="#">Mark Henry</a></h4>
                                        <p>
                                            working
                                        </p>
                                    </div>
                                    <div class="user-status text-info">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb">
                                        <a href="#"><img src="images/avatar1.jpg" alt=""></a>
                                    </div>
                                    <div class="user-details">
                                        <h4><a href="#">Shila Jones</a></h4>
                                        <p>
                                            Work for fun
                                        </p>
                                    </div>
                                    <div class="user-status text-danger">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                </div>
                                <p class="text-center">
                                    <a href="#" class="view-btn">View all Contacts</a>
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li class="widget-collapsible">
                        <a href="#" class="head widget-head purple-bg active">
        <span class="pull-left"> recent activity (3)</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
                        <ul class="widget-container">
                            <li>
                                <div class="prog-row">
                                    <div class="user-thumb rsn-activity">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="rsn-details ">
                                        <p class="text-muted">
                                            just now
                                        </p>
                                        <p>
                                            <a href="#">Jim Doe </a>Purchased new equipments for zonal office setup
                                        </p>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb rsn-activity">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="rsn-details ">
                                        <p class="text-muted">
                                            2 min ago
                                        </p>
                                        <p>
                                            <a href="#">Jane Doe </a>Purchased new equipments for zonal office setup
                                        </p>
                                    </div>
                                </div>
                                <div class="prog-row">
                                    <div class="user-thumb rsn-activity">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="rsn-details ">
                                        <p class="text-muted">
                                            1 day ago
                                        </p>
                                        <p>
                                            <a href="#">Jim Doe </a>Purchased new equipments for zonal office setup
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="widget-collapsible">
                        <a href="#" class="head widget-head yellow-bg active">
        <span class="pull-left"> shipment status</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
                        <ul class="widget-container">
                            <li>
                                <div class="col-md-12">
                                    <div class="prog-row">
                                        <p>
                                            Full sleeve baby wear (SL: 17665)
                                        </p>
                                        <div class="progress progress-xs mtop10">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="prog-row">
                                        <p>
                                            Full sleeve baby wear (SL: 17665)
                                        </p>
                                        <div class="progress progress-xs mtop10">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                                <span class="sr-only">70% Completed</span>
                                            </div>
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
    <script src="../../js/jquery-1.8.3.min.js"></script>
    <script src="../../bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../js/jquery.scrollTo.min.js"></script>
    <script src="../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../../js/jquery.nicescroll.js"></script>
    <!--Easy Pie Chart-->
    <script src="../../js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="../../js/sparkline/jquery.sparkline.js"></script>
    <!--jQuery Flot Chart-->
    <script src="../../js/flot-chart/jquery.flot.js"></script>
    <script src="../../js/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="../../js/flot-chart/jquery.flot.resize.js"></script>
    <script src="../../js/flot-chart/jquery.flot.pie.resize.js"></script>

    <script type="text/javascript" src="../../js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="sweetalert/sweetalert.min.js"></script>

    <script src="../../js/jquery.js"></script>
    <script src="../../bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../js/jquery.scrollTo.min.js"></script>
    <script src="../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../../js/jquery.nicescroll.js"></script>
    <!-- Easy Pie Chart-->
    <script src="../../js/easypiechart/jquery.easypiechart.js"></script>
    <!-- Sparkline Chart-->
    <script src="../../js/sparkline/jquery.sparkline.js"></script>
    <!-- jQuery Flot Chart-->
    <script src="../../js/flot-chart/jquery.flot.js"></script>
    <script src="../../js/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="../../js/flot-chart/jquery.flot.resize.js"></script>
    <script src="../../js/flot-chart/jquery.flot.pie.resize.js"></script>
    <script src="../../js/flot-chart/jquery.flot.selection.js"></script>
    <script src="../../js/flot-chart/jquery.flot.stack.js"></script>
    <script src="../../js/flot-chart/jquery.flot.time.js"></script>
    <script src="../../js/flot.chart.init.js"></script>
    <!-- Common script init for all pages-->
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


</body>

</html>
