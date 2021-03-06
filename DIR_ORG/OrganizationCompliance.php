<!DOCTYPE html>
<html>
<title>OSAS - Compliance</title>
<head>
    <?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Organization profile</a></li> </ul></div>";
$currentPage ='OSAS_OrgCompliance';
include('header.php');
include('../config/connection.php');
?>

        <body>
            <section id="container">
                <!--header end-->
                <aside>
                    <div id="sidebar" class="nav-collapse">
                        <!-- sidebar menu start-->
                        <?php

                include('sidenav.php')

                ?>
                            <!-- sidebar menu end-->
                    </div>
                </aside>
                <!--sidebar end-->
                <!--main content start-->
                <section id="main-content">
                    <section class="wrapper">
                        <!-- page start-->
                        <div class="row" style="float:right;"> </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <header class="panel-heading"> Organization Management <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                    <div class="panel-body">
                                        <div class="adv-table editable-table ">
                                            <div class="clearfix">
                                                <div class="btn-group">
                                                    <button id="editable-sample_new" data-toggle="modal" href="#Add" class="btn btn-success"> Add New <i class="fa fa-plus"></i> </button>
                                                </div>
                                                <div class="btn-group pull-right">
                                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
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
                                                        <th>Organization Code</th>
                                                        <th>Organization Name</th>
                                                        <th>Organization Adviser</th>
                                                        <th>Organization Category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php


                                        $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,OrgForCompliance_ADVISER,OrgAppProfile_STATUS,OC.OrgCat_NAME FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE INNER JOIN t_assign_org_category AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE INNER JOIN r_org_category OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active'");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["OrgForCompliance_ORG_CODE"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $adv = $row["OrgForCompliance_ADVISER"];
                                            $cat = $row["OrgCat_NAME"];


                                            echo "
                                            <tr class=''>
                                                <td>$code</td>
                                                <td>$name</td>
                                                <td>$adv</td>
                                                <td>$cat</td>
                                                <td style='width:200px'>
                                                    <center><a class='btn btn-cancel view tar' style='color:white' data-toggle='modal' href='#View' href='javascript:;'><i class='fa  fa-eye'></i></a>
                                                    <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>
                                                    <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a>
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                        }



									?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Organization Code</th>
                                                        <th>Organization Name</th>
                                                        <th>Organization Adviser</th>
                                                        <th>Organization Category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
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
                                                <div class="target-sell"> </div>
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
                            <h4 class="modal-title"> Organization Profile</h4> </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="form-data">
                                        <div class="row" id="profile">
                                            <div class="col-lg-6 form-group"> Applicant
                                                <select class="form-control input-sm m-bot15 selectAppCode" style="width:100%" id="drpappcode">
                                                    <?php

                                                $view_query = mysqli_query($con,"SELECT * FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE NOT IN (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active')");
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $name = $row["OrgAppProfile_NAME"];
                                                    $code = $row["OrgAppProfile_APPL_CODE"];

                                                    echo "
                                                        <option value='$code'>$name</option>
                                                            ";
                                                }



                                            ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-6 form-group"> Academic Year
                                                        <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="drpyear">
                                                            <?php

                                                                            $view_query = mysqli_query($con,"SELECT Batch_YEAR AS YEAR FROM `r_batch_details` WHERE Batch_DISPLAY_STAT = 'Active'");
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
                                                    <div class="col-lg-6 form-group"> Adviser Name
                                                        <input name="emailadd" type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="txtadvname"> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <div class="col-lg-6 form-group"> Organization Category
                                                        <select class="form-control input-sm m-bot15 selectYear" id="drpcat">
                                                            <?php

                                                                    $view_query = mysqli_query($con,"SELECT OrgCat_CODE AS CODE , OrgCat_NAME AS NAME FROM `r_org_category` WHERE OrgCat_DISPLAY_STAT = 'Active'");
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
                                                    <div class="col-lg-6 form-group" id="course"> Course
                                                        <select class="form-control input-sm m-bot15 selectYear" id="drpcourse">
                                                            <?php

                                                                    $view_query = mysqli_query($con,"SELECT Course_CODE as CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active'");
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
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Mission</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtmission" style="roverflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Vision</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtvision" style="overflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                            <h4 class="modal-title"> Organization Profile:
                        <prof id="updappcode"></prof>
                    </h4> </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="form-data">
                                        <div class="row" id="profile">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-6 form-group"> Academic Year
                                                        <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="upddrpyear"> </select>
                                                    </div>
                                                    <div class="col-lg-6 form-group"> Adviser Name
                                                        <input name="emailadd" type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="updtxtadvname"> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <div class="col-lg-6 form-group"> Organization Category
                                                        <select class="form-control input-sm m-bot15 selectYear" id="upddrpcat"> </select>
                                                    </div>
                                                    <div class="col-lg-6 form-group" id="updcourse"> Course
                                                        <select class="form-control input-sm m-bot15 selectYear" id="upddrpcourse"> </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Mission</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="updtxtmission" style="roverflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label> Vision</label>
                                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="updtxtvision" style="overflow:auto;resize:none"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                            <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="View" class="modal fade">
                <div class="modal-dialog" style="width:55%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Organization Details</h4> </div>
                        <div class="modal-body">
                            <div class="twt-feed blue-bg">
                                <div class="corner-ribon black-ribon"> <i class="fa fa-group"></i> </div>
                                <div class="fa fa-group wtt-mark"></div>
                                <a href="#"> <img alt="" src="../../../ASSETS/images/OSAS/Organization_Icon.png"> </a>
                                <h1 id="lblcode"></h1>
                                <p id="lblname"></p>
                                <p id="lbladvname"></p>
                            </div>
                            <div class="weather-category twt-category">
                                <ul>
                                    <li class="active" id="lblprof"> <a id="prof">Profile</a> </li>
                                    <li id="lblmem"> <a id="mem" style="color:#BDBDC3">Members</a> </li>
                                    <li id="lblstat"> <a id="stat" style="color:#BDBDC3">Status</a> </li>
                                </ul>
                            </div>
                            <div id="bodyprof">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="mini-stat clearfix" style="border:solid">
                                            <div class="mini-stat-info"> <span style="font-size:15px">Organization Category</span> <span id="lblcat" style="font-size:13px"></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mini-stat clearfix" style="border:solid">
                                            <div class="mini-stat-info"> <span style="font-size:15px">Academic Year</span> <span id="lblyear" style="font-size:13px"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="mini-stat clearfix" style="border:solid">
                                            <div class="mini-stat-info"> <span style="font-size:15px">Vision</span> <span id="lblvision" style="font-size:13px"></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mini-stat clearfix" style="border:solid">
                                            <div class="mini-stat-info"> <span style="font-size:15px">Mission</span> <span id="lblmission" style="font-size:13px"></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bodymem">
                                <div class="row">
                                    <div class="col-md-12">
                                        <section class="panel">
                                            <div class="panel-body">
                                                <div class="clearfix">
                                                    <div class="btn-group pull-right">
                                                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i> </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#">Print</a></li>
                                                            <li><a href="#">Save as PDF</a></li>
                                                            <li><a href="#">Export to Excel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="adv-table proftable ">
                                                    <div class="space15"></div>
                                                    <table class="table table-striped table-hover table-bordered" id="proftable">
                                                        <thead>
                                                            <tr>
                                                                <th>Student Number</th>
                                                                <th>Student Name</th>
                                                                <th>Course - Year and Section</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="updaccreqlist"> </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div id="bodystat">
                                <div class="col-lg-12">
                                    <div style='padding-top:10px'>
                                        <div class='progress progress-striped progress-xs'>
                                            <div style='width: 10%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='40' role='progressbar' class='progress-bar progress-bar-success' id="prgbar"> <span class='sr-only'></span> </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Accreditation Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="accreqlist"> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        $codelist = array();
        $j = 1;

        $view_query = mysqli_query($con,"SELECT OrgAccrDetail_CODE as CODE FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
        while($row = mysqli_fetch_array($view_query))
        {
            $codelist = $row['CODE'];

        }
    ?>
                <?php include("footer.php") ?>
                    <!--script for this page only-->
                    <script src="Organization/OrganizationCompliance.js"></script>
                    <!-- END JAVASCRIPTS -->
                    <script>
                        $(document).ready(function () {
                            $('#drpcat').change(function () {
                                var e = document.getElementById("drpcat");
                                var getcat = e.options[e.selectedIndex].text;
                                if (getcat == 'Academic Organization') $('#course').removeClass('hidden');
                                else $('#course').addClass('hidden');
                            });
                            $('#upddrpcat').change(function () {
                                var e = document.getElementById("upddrpcat");
                                var getcat = e.options[e.selectedIndex].text;
                                if (getcat == 'Academic Organization') $('#updcourse').removeClass('hidden');
                                else $('#updcourse').addClass('hidden');
                            });
                            $('.edit').click(function () {});
                            $('#submit-data').click(function () {
                                var e = document.getElementById('drpappcode');
                                var code = e.options[e.selectedIndex].value;
                                var appname = e.options[e.selectedIndex].text;
                                var advname = document.getElementById('txtadvname').value;
                                var drpyear = document.getElementById('drpyear').value;
                                var drpcate = document.getElementById('drpcat');
                                var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                                var drpcatcode = drpcate.options[drpcate.selectedIndex].value;
                                var drpcourse = document.getElementById('drpcourse').value;
                                var txtvision = document.getElementById('txtvision').value;
                                var txtmission = document.getElementById('txtmission').value;
                                var compcode = code + drpyear.substring(0, 4);
                                swal({
                                    title: "Are you sure?"
                                    , text: "This data will be saved and used for further transaction"
                                    , type: "warning"
                                    , showCancelButton: true
                                    , confirmButtonColor: '#DD6B55'
                                    , confirmButtonText: 'Yes!'
                                    , cancelButtonText: "No!"
                                    , closeOnConfirm: false
                                    , closeOnCancel: false
                                }, function (isConfirm) {
                                    if (isConfirm) {
                                        $.ajax({
                                            type: 'post'
                                            , url: 'Organization/OrganizationCompliance/Add-ajax.php'
                                            , data: {
                                                _code: code
                                                , _compcode: compcode
                                                , _advname: advname
                                                , _drpyear: drpyear
                                                , _drpcatcode: drpcatcode
                                                , _drpcatname: drpcatname
                                                , _drpcou: drpcourse
                                                , _vision: txtvision
                                                , _name: appname
                                                , _mission: txtmission
                                            }
                                            , success: function (response) {
                                                swal("Record Updated!", "The data is successfully Added!", "success");
                                                document.getElementById("form-data").reset();
                                            }
                                            , error: function (response) {
                                                swal("Error encountered while adding data", "Please try again", "error");
                                            }
                                        });
                                    }
                                    else swal("Cancelled", "The transaction is cancelled", "error");
                                });
                            });
                        });
                        jQuery(document).ready(function () {
                            initproftable.init();
                            EditableTable.init();
                        });
                    </script>
        </body>

</html>
