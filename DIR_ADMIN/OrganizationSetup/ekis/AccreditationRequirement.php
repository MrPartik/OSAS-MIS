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
    <link href="../ASSETS/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ASSETS/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../ASSETS/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link rel="../stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../ASSETS/css/style.css" rel="stylesheet">
    <link href="../ASSETS/css/style-responsive.css" rel="stylesheet" />
	<link href="../sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">

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

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.html" class="logo">
        <img src="images/logo.png" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">

        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/avatar1_small.jpg">
                <span class="username">John Doe</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
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
						<i class="fa fa-th"></i>
						<span>Student Setup</span>
					</a>
					<ul class="sub">
						<li><a href="basic_table.html">Assistance Title</a></li>
						<li><a href="responsive_table.html">Semester</a></li>
					</ul>
				</li>
				<li class="sub-menu">
					<a href="javascript:;">
						<i class="fa fa-th"></i>
						<span>Organization Setup</span>
					</a>
					<ul class="sub">
						<li><a href="basic_table.html">Accreditation Requirement</a></li>
						<li><a href="responsive_table.html">Course</a></li>
						<li><a href="responsive_table.html">Organization Category</a></li>
					</ul>
				</li>				
				<li class="sub-menu">
					<a href="javascript:;">
						<i class="fa fa-th"></i>
						<span>Sanction Setup</span>
					</a>
					<ul class="sub">
						<li><a href="basic_table.html">Sanction Setup</a></li>
						<li><a href="responsive_table.html">Designated Office</a></li>
						<li><a href="responsive_table.html">Clearance Signatory</a></li>
						<li><a href="responsive_table.html">Sanction Detail</a></li>
					</ul>
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
		<div class="row" style="float:right;">
			<div class="col-md-12  ">
				<!--breadcrumbs start -->
				<ul class="breadcrumbs-alt ">
					 <li>
						<a class="current" href="#">Accreditation Requirement</a>
					</li>                       
					<li>
						<a href="#">Organization Setup</a>
					</li>
				</ul>
				<!--breadcrumbs end -->
			</div>
		</div>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button id="editable-sample_new" class="btn btn-success">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Requirement Code</th>
                                    <th>Requirement Name</th>
                                    <th>Requirement Description</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
									<?php
							
										include('../connection.php');
										$view_query = mysqli_query($connection,"select * from `r_org_accreditation_details` where OrgAccrDetail_DISPLAY_STAT = 1");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["OrgAccrDetail_CODE"];
											$name = $row["OrgAccrDetail_NAME"];
											$desc = $row["OrgAccrDetail_DESC"];										
											
											echo "
											<tr class=''>
												<td>$code</td>
												<td>$name</td>
												<td >$desc</td>
												<td style='width:150px'>
													<center>
														<a class='btn btn-success edit' href='javascript:;'>Edit</a>
														<a class='btn btn-danger delete' href='javascript:;'>Delete</a>								
													<center>
												</td>
											</tr>
											";
										}			
											
										
									?>								
																
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
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

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="../ASSETS/js/jquery-1.8.3.min.js"></script>
<script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
<script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="../ASSETS/js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="../ASSETS/js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="../ASSETS/js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="../ASSETS/js/flot-chart/jquery.flot.js"></script>
<script src="../ASSETS/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="../ASSETS/js/flot-chart/jquery.flot.resize.js"></script>
<script src="../ASSETS/js/flot-chart/jquery.flot.pie.resize.js"></script>

<script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="../sweetalert/sweetalert.min.js"></script>   

<!--common script init for all pages-->
<script src="../ASSETS/js/scripts.js"></script>

<!--script for this page only-->
<script src="AccreditationRequirement.js"></script>

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });


	
	
</script>

</body>
</html>
