<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="AccountClassification.aspx.cs" Inherits="GeneralLedger.SystemSetup.AccountClassification" %>

    <!DOCTYPE html>

    <html xmlns="http://www.w3.org/1999/xhtml">

    <head runat="server">
        <title>System Setup - Account Classification</title>
        <link rel="shortcut icon" href="../images/favicon.png" />
        <link href="../bs3/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />
        <link href="../css/bootstrap-reset.css" rel="stylesheet" />
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="../js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
        <link href="../css/clndr.css" rel="stylesheet" />
        <link href="../js/css3clock/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="../js/morris-chart/morris.css" />
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link href="../sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
        <link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />
        <link href="../bs3/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />
        <link href="../css/bootstrap-reset.css" rel="stylesheet" />
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="../js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
        <link href="../css/clndr.css" rel="stylesheet" />
        <link href="../js/css3clock/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="../js/morris-chart/morris.css" />
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link href="../js/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/style-responsive.css" rel="stylesheet" />

    </head>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">

                <a href="dashboard.php" class="logo"> 
        <img src="../../../images/logo.png" alt=""/> 
    </a>

                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search" />
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="../../../images/OSAS/zxc.png"/>
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
    </section>

    <body>
        <section id="container2">
            <aside>
                <div id="sidebar" class="nav-collapse">
                    <aside>
                        <div id="sidebar" class="nav-collapse">
                            <!-- sidebar menu start-->
                            <div class="leftside-navigation">
                                <ul class="sidebar-menu" id="nav-accordion">
                                    <li>
                                        <a <?php if( $currentPage==='OSAS_AdminDashboard' ) {echo 'class="active"';} ?> href="../Dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a>
                                    </li>
                                    <li class="sub-menu">
                                        <a <?php if( $currentPage==='OSAS_BatchYear' || $currentPage==='OSAS_Title' || $currentPage==='OSAS_Semester' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Student Setup</span>
                    </a>
                                        <ul class="sub">
                                            <li <?php if( $currentPage==='OSAS_Title' ) { echo 'class="active"';} ?>><a href="../StudentSetup/FinancialAssistanceTitle.php">Assistance Title</a></li>
                                            <li <?php if( $currentPage==='OSAS_BatchYear' ) { echo 'class="active"';} ?> ><a href="../StudentSetup/BatchYear.php">Batch Year</a></li>
                                            <li <?php if( $currentPage==='OSAS_Semester' ) { echo 'class="active"';} ?>><a href="../StudentSetup/Semester.php">Semester</a></li>
                                        </ul>
                                    </li>
                                    <li class="sub-menu">
                                        <a <?php if( $currentPage==='OSAS_AccreditationRequirement' || $currentPage==='OSAS_Course' || $currentPage==='OSAS_OfficerPosition' || $currentPage==='OSAS_OrganizationCategory' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Organization Setup</span>
                    </a>
                                        <ul class="sub">
                                            <li <?php if( $currentPage==='OSAS_AccreditationRequirement' ) { echo 'class="active"';} ?> ><a href="../OrganizationSetup/AccreditationRequirement.php">Accreditation Requirement</a></li>
                                            <li <?php if( $currentPage==='OSAS_Course' ) { echo 'class="active"';} ?>><a href="../OrganizationSetup/Course.php">Course</a></li>
                                            <li <?php if( $currentPage==='OSAS_OrganizationCategory' ) { echo 'class="active"';} ?>><a href="../OrganizationSetup/OrganizationCategory.php">Organization Category</a></li>
                                            <li <?php if( $currentPage==='OSAS_OfficerPosition' ) { echo 'class="active"';} ?>><a href="../OrganizationSetup/OfficerPosition.php">Officer Position</a></li>
                                        </ul>
                                    </li>
                                    <li class="sub-menu">
                                        <a <?php if( $currentPage==='OSAS_ClearanceSignatory' || $currentPage==='OSAS_DesignatedOffice' || $currentPage==='OSAS_SanctionDetail' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Sanction Setup</span>
                    </a>
                                        <ul class="sub">
                                            <li <?php if( $currentPage==='OSAS_ClearanceSignatory' ) { echo 'class="active"';} ?> ><a href="../SanctionSetup/ClearanceSignatory.php">Clearance Signatory</a></li>
                                            <li <?php if( $currentPage==='OSAS_DesignatedOffice' ) { echo 'class="active"';} ?>><a href="../SanctionSetup/DesignatedOffice.php">Designated Office</a></li>
                                            <li <?php if( $currentPage==='OSAS_SanctionDetail' ) { echo 'class="active"';} ?>><a href="../SanctionSetup/SanctionDetail.php">Sanction Detail</a></li>
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
                </div>
            </aside>
        </section>
    </body>

    </html>
