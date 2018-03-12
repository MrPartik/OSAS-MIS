<!DOCTYPE html>
<html>

<head>
    <?php include('../header.php');    
$currentPage ='OSAS_StudProfile'; include('../../../config/connection.php');
?>
    <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/style-responsive.css" rel="stylesheet" />
</head>

<body>

    <section id="container">
        r
        <!--header end-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <?php
                
                include('../../sidenav.php')
            
                ?>
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
                                <a href="#">Sanction Setup</a>
                            </li>
                            <!-- <li> -->
                            <!-- <a class="active-trail active" href="#">Pages</a> -->
                            <!-- </li> -->

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
                                            <button id="editable-sample_new" data-toggle="modal" href="#Add" class="btn btn-success">
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
                                                <th>Organization Name</th>
                                                <th>Organization Description</th>
                                                <th>Organization Status</th>
                                                <th>Action</th>
                                                <th class='hidden'>ID</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							
										include('../connection.php');
                
                                        $view_query = mysqli_query($connection,"SELECT * FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active'");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["OrgAppProfile_APPL_CODE"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $desc = $row["OrgAppProfile_DESCRIPTION"];										
                                            $stat = $row["OrgAppProfile_STATUS"];
                                            $id = $row["OrgAppProfile_ID"];

                                            echo "
                                            <tr class=''>
                                                <td>$code</td>
                                                <td>$name</td>
                                                <td>$desc</td>
                                                <td style='width:200px'>
                                                    <center><a class='btn btn-cancel tar edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'>Profile</a>
														<a class='btn btn-danger delete' href='javascript:;'>Delete</a>	
                                                    </center>
                                                </td>
                                                <td class='hidden'>$id</td>
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
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Student</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading tab-bg-dark-navy-blue">
                                <ul class="nav nav-tabs nav-justified ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#overview">
                                    Profile
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#essential">
                                    Essential
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#job-history">
                                    Compliance
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#accreditation">
                                    Accreditation
                                </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content tasi-tab">
                                    <div id="overview" class="tab-pane active">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <form method="post" id="form-data">
                                                    <div class="row" id="profile">
                                                        <div class="col-lg-6 form-group">
                                                            Organization Application Code <input name="studno" type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" id="txtcode">
                                                        </div>
                                                        <div class="col-lg-6 form-group">
                                                            Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtname">
                                                        </div>
                                                        <div class="col-lg-6 form-group">
                                                            Organization Category
                                                            <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpcat"> 
                                                                <?php

                                                                    $view_query = mysqli_query($connection,"SELECT OrgCat_CODE AS CODE , OrgCat_NAME AS NAME FROM `r_org_category` WHERE OrgCat_DISPLAY_STAT = 'Active'");
                                                                    while($row = mysqli_fetch_assoc($view_query))
                                                                    {
                                                                        $catcode = $row["CODE"];
                                                                        $catname = $row["NAME"];

                                                                        echo "
                                                                            <option value='$catcode'>$catname</option>
                                                                                ";
                                                                    }	



                                                                ?>  
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 form-group" id="course">
                                                            Course
                                                            <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpcourse"> 
                                                                <?php

                                                                    $view_query = mysqli_query($connection,"SELECT Course_CODE as CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active'");
                                                                    while($row = mysqli_fetch_assoc($view_query))
                                                                    {
                                                                        $coucode = $row["CODE"];

                                                                        echo "
                                                                            <option value='$coucode'>$coucode</option>
                                                                                ";
                                                                    }	



                                                                ?>                          
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-12 form-group">
                                                            Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                                                        </div>
                                                        <div class="col-lg-3 form-group">
                                                            <input type="checkbox" id="chkacc" name="chkacc" class="checkbox form-control" style="width: 20px">
                                                            <label for="chkacc">Accredited</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="essential" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="post" id="form-data2">
                                                    <center>
                                                        <div class="col-md-5 img-modal">
                                                            <img src="../images/gallery/image1.jpg" alt="">
                                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-upload"></i> Upload Image</a>
                                                            <p><strong>Logo</strong></p>
                                                            <p class="mtop10"><strong>File Name:</strong> img01.jpg</p>
                                                            <p><strong>File Type:</strong> jpg</p>
                                                            <p><strong>Resolution:</strong> 300x200</p>
                                                            <p><strong>Uploaded By:</strong> <a href="#">ThemeBucket</a></p>
                                                        </div>
                                                    </center>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label> Mission</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtmission" style="roverflow:auto;resize:none"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Vision</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtvision" style="overflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="job-history" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <form method="post" id="form-data3">
                                                            <div class="row" id="profile">
                                                                <div class="col-lg-6 form-group">
                                                                    Organization Code<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtcompcode">
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    Adviser Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtadvname">
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    Batch Year
                                                                    <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpyear"> 
                                                                        <?php

                                                                            $view_query = mysqli_query($connection,"SELECT Batch_YEAR AS YEAR FROM `r_batch_details` WHERE Batch_DISPLAY_STAT = 'Active'");
                                                                            while($row = mysqli_fetch_assoc($view_query))
                                                                            {
                                                                                $year = $row["YEAR"];

                                                                                echo "
                                                                                    <option value='$year'>$year</option>
                                                                                        ";
                                                                            }	



                                                                        ?>  
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accreditation" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <form method="post" id="form-data4">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Accreditation Name</th>
                                                                        <th>Status</th>
                                                                        <th class='hidden'>code</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                            
                                                                            $view_query = mysqli_query($connection,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
                                                                            $i = 0;
                                                                            while($row = mysqli_fetch_assoc($view_query))
                                                                            {
                                                                                $i++;
                                                                                $desc = $row["des"];
                                                                                $code = $row["code"];
                                                                                echo "
                                                                                <tr class=''>
                                                                                    <td>$i</td>
                                                                                    <td >$desc</td>
                                                                                    <td><input type='checkbox' id='chkstat$i' name='chkacc' class='checkbox form-control' style='width: 20px'></td>

                                                                                    <td id='code$i' class='hidden'>$code</td>
                                                                                </tr>
                                                                                        ";
                                                                            }			


                                                                       ?>

                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success " id="submit-data" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Student</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading tab-bg-dark-navy-blue">
                                <ul class="nav nav-tabs nav-justified ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#updoverview">
                                    Profile
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#updessential">
                                    Essential
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#updjob-history">
                                    Compliance
                                </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#updaccreditation">
                                    Accreditation
                                </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content tasi-tab">
                                    <div id="updoverview" class="tab-pane active">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="post" id="form-data">
                                                    <div class="row" id="profile">
                                                        <div class="col-lg-6 form-group">
                                                            Organization Application Code <input name="studno" type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" id="txtupdcode">
                                                        </div>
                                                        <div class="col-lg-6 form-group">
                                                            Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdname">
                                                        </div>
                                                        <div class="col-lg-6 form-group">
                                                            Organization Category
                                                            <select class="form-control input-sm m-bot15 selectupdYear" style="width:100%" id="drpupdcat"> 
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 form-group" id="updcourse">
                                                            Course
                                                            <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpupdcourse"> 
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-12 form-group">
                                                            Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                                                        </div>
                                                        <input name="studno" type="text" class="form-control" id="txtgetid">
                                                        <div class="col-lg-3 form-group">
                                                            <input type="checkbox" id="chkupdacc" name="chkupdacc" class="checkbox form-control" style="width: 20px">
                                                            <label for="chkacc">Accredited</label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="updessential" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form method="post" id="form-data2">
                                                    <center>
                                                        <div class="col-md-5 img-modal">
                                                            <img src="../images/gallery/image1.jpg" alt="">
                                                            <a href="#" class="btn btn-white btn-sm"><i class="fa fa-upload"></i> Upload Image</a>
                                                            <p><strong>Logo</strong></p>
                                                            <p class="mtop10"><strong>File Name:</strong> img01.jpg</p>
                                                            <p><strong>File Type:</strong> jpg</p>
                                                            <p><strong>Resolution:</strong> 300x200</p>
                                                            <p><strong>Uploaded By:</strong> <a href="#">ThemeBucket</a></p>
                                                        </div>
                                                    </center>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label> Mission</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupdmission" style="roverflow:auto;resize:none"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Vision</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupdvision" style="overflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="updjob-history" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <form method="post" id="form-data3">
                                                            <div class="row" id="profile">
                                                                <div class="col-lg-6 form-group">
                                                                    Organization Code<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdcompcode">
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    Adviser Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdadvname">
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    Batch Year
                                                                    <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpupdyear"> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="updaccreditation" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <form method="post" id="form-data4">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Accreditation Name</th>
                                                                        <th>Status</th>
                                                                        <th class='hidden'>code</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="updtbody">

                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="../../../js/jquery-1.8.3.min.js"></script>
    <script src="../../../bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../../js/jquery.scrollTo.min.js"></script>
    <script src="../../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../../../js/jquery.nicescroll.js"></script>
    <!--Easy Pie Chart-->
    <script src="../../../js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="../../../js/sparkline/jquery.sparkline.js"></script>
    <!--jQuery Flot Chart-->
    <script src="../js/flot-chart/jquery.flot.js"></script>
    <script src="../../../js/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="../../../js/flot-chart/jquery.flot.resize.js"></script>
    <script src="../../../js/flot-chart/jquery.flot.pie.resize.js"></script>

    <script type="text/javascript" src="../../../js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../../js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../sweetalert/sweetalert.min.js"></script>

    <!--common script init for all pages-->
    <script src="../../../js/scripts.js"></script>

    <!--script for this page only-->
    <script src="DesignatedOffice.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#drpcat').change(function() {
                var e = document.getElementById("drpcat");
                var getcat = e.options[e.selectedIndex].text;
                if (getcat == 'Academic Organization')
                    $('#course').removeClass('hidden');
                else
                    $('#course').addClass('hidden');


            });
            $('#drpupdcat').change(function() {
                var e = document.getElementById("drpupdcat");
                var getcat = e.options[e.selectedIndex].text;
                if (getcat == 'Academic Organization')
                    $('#updcourse').removeClass('hidden');
                else
                    $('#updcourse').addClass('hidden');


            });
            $('.edit').click(function() {


            });

            $('#submit-data').click(function() {
                var code = document.getElementById('txtcode').value;
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var acc = document.getElementById('chkacc');
                var accstat = '';
                var compcode = document.getElementById('txtcompcode').value;
                var advname = document.getElementById('txtadvname').value;
                var drpyear = document.getElementById('drpyear').value;
                var drpcate = document.getElementById('drpcat');
                var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                var drpcatcode = drpcate.options[drpcate.selectedIndex].value;
                var drpcourse = document.getElementById('drpcourse').value;
                var mission = document.getElementById('txtmission').value;
                var vision = document.getElementById('txtvision').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;

                if (acc.checked)
                    accstat = 'This application is ready for accreditation';
                else
                    accstat = 'Marami pang aasikasuhin';

                swal({
                    title: "Are you sure?",
                    text: "This data will be saved and used for further transaction",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Add it!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {



                        $.ajax({
                            type: 'post',
                            url: 'OrgProfile/Add-ajax.php',
                            data: {
                                _code: code,
                                _name: name,
                                _desc: desc,
                                _accstat: accstat,
                                _compcode: compcode,
                                _advname: advname,
                                _drpyear: drpyear,
                                _drpcatcode: drpcatcode,
                                _drpcatname: drpcatname,
                                _drpcou: drpcourse,
                                _mission: mission,
                                _vision: vision


                            },
                            success: function(response) {



                            },
                            error: function(response) {

                            }
                        });

                        for (x = 1; x <= <?php echo $i; ?>; x++) {

                            chkstat = document.getElementById('chkstat' + x);
                            if (chkstat.checked)
                                stat = 1;
                            else
                                stat = 0;
                            reccode = document.getElementById('code' + x).innerText;
                            alert(reccode + ' ' + compcode + ' ' + stat);
                            $.ajax({
                                type: 'post',
                                url: 'OrgProfile/AccReq-ajax.php',
                                data: {
                                    _compcode: compcode,
                                    _reccode: reccode,
                                    _stat: stat

                                },
                                success: function(response) {
                                    swal("Record Updated!", "The data is successfully Added!", "success");
                                    //document.getElementById("form-data").reset();
                                },
                                error: function(response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }
                            });


                        }

                    } else swal("Cancelled", "The transaction is cancelled", "error");
                });

            });

            $('#updsubmit-data').click(function() {
                var code = document.getElementById('txtupdcode').value;
                var name = document.getElementById('txtupdname').value;
                var desc = document.getElementById('txtupddesc').value;
                var acc = document.getElementById('chkupdacc');
                var accstat = '';
                var compcode = document.getElementById('txtupdcompcode').value;
                var advname = document.getElementById('txtupdadvname').value;
                var drpyear = document.getElementById('drpupdyear').value;
                var drpcate = document.getElementById('drpupdcat');
                var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                var drpcatcode = drpcate.options[drpcate.selectedIndex].value;
                var drpcourse = document.getElementById('drpupdcourse').value;
                var mission = document.getElementById('txtupdmission').value;
                var vision = document.getElementById('txtupdvision').value;
                var getid = document.getElementById('txtgetid').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;

                if (acc.checked)
                    accstat = 'This application is ready for accreditation';
                else
                    accstat = 'Marami pang aasikasuhin';

                swal({
                    title: "Are you sure?",
                    text: "This data will be saved and used for further transaction",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Add it!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {

                        alert(compcode);
                        for (x = 1; x <= <?php echo $i; ?>; x++) {

                            chkstat = document.getElementById('chkupdstat' + x);
                            if (chkstat.checked)
                                stat = 1;
                            else
                                stat = 0;
                            reccode = document.getElementById('updcode' + x).innerText;
                            $.ajax({
                                type: 'post',
                                url: 'OrgProfile/UpdAccReq-ajax.php',
                                data: {
                                    _getid: getid,
                                    _compcode: compcode,
                                    _reccode: reccode,
                                    _stat: stat



                                },
                                success: function(response) {

                                    //document.getElementById("form-data").reset();
                                },
                                error: function(response) {

                                }
                            });


                        }
                        $.ajax({
                            type: 'post',
                            url: 'OrgProfile/Update-ajax.php',
                            data: {
                                _id: getid,
                                _code: code,
                                _name: name,
                                _desc: desc,
                                _accstat: accstat,
                                _compcode: compcode,
                                _advname: advname,
                                _drpyear: drpyear,
                                _drpcatcode: drpcatcode,
                                _drpcatname: drpcatname,
                                _drpcou: drpcourse,
                                _mission: mission,
                                _vision: vision


                            },
                            success: function(response) {
                                swal("Record Updated!", "The data is successfully Added!", "success");



                            },
                            error: function(response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                            }
                        });





                    } else swal("Cancelled", "The transaction is cancelled", "error");
                });

            });
        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
