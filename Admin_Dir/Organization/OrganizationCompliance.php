<!DOCTYPE html>
<html>

<head>
    <?php include('../header.php');    
$currentPage ='OSAS_OrgProfile'; include('../../../config/connection.php');
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
                                                <th>Organization Code</th>
                                                <th>Organization Name</th>
                                                <th>Organization Adviser</th>
                                                <th>Organization Category</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							
										include('../connection.php');
                
                                        $view_query = mysqli_query($connection,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,OrgForCompliance_ADVISER,OrgAppProfile_STATUS,OC.OrgCat_NAME FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE INNER JOIN t_assign_org_category AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE INNER JOIN r_org_category OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active'");
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
                                                    <center><a class='btn btn-cancel tar edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'>Profile</a>
														<a class='btn btn-danger delete' href='javascript:;'>Delete</a>	
                                                    </center>
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
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"> Organization Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="form-data">
                                <div class="row" id="profile">
                                    <div class="col-lg-6 form-group">
                                        Applicant
                                        <select class="form-control input-sm m-bot15 selectAppCode" style="width:100%" id="drpappcode"> 
                                                                <?php

                                                                    $view_query = mysqli_query($connection,"SELECT * FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE NOT IN (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active')");
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
                                            <div class="col-lg-6 form-group">
                                                Adviser Name<input name="emailadd" type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="txtadvname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <div class="col-lg-6 form-group">
                                                Organization Category
                                                <select class="form-control input-sm m-bot15 selectYear" id="drpcat"> 
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
                                                <select class="form-control input-sm m-bot15 selectYear" id="drpcourse"> 
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
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="form-data">
                                <div class="row" id="profile">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6 form-group">
                                                Batch Year
                                                <select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="upddrpyear"> 
                                                 </select>
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                Adviser Name<input name="emailadd" type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="updtxtadvname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <div class="col-lg-6 form-group">
                                                Organization Category
                                                <select class="form-control input-sm m-bot15 selectYear" id="upddrpcat"> 
                                                </select>
                                            </div>
                                            <div class="col-lg-6 form-group" id="updcourse">
                                                Course
                                                <select class="form-control input-sm m-bot15 selectYear" id="upddrpcourse">                       
                                                </select>
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
    <?php
    
        $codelist = array();
        $j = 1;
    
        $view_query = mysqli_query($connection,"SELECT OrgAccrDetail_CODE as CODE FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
        while($row = mysqli_fetch_array($view_query))
        {   
            $codelist = $row['CODE'];

        }
    
    
    
    ?>
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
        <script src="OrganizationCompliance.js"></script>

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

                $('#upddrpcat').change(function() {
                    var e = document.getElementById("upddrpcat");
                    var getcat = e.options[e.selectedIndex].text;
                    if (getcat == 'Academic Organization')
                        $('#updcourse').removeClass('hidden');
                    else
                        $('#updcourse').addClass('hidden');


                });
                $('.edit').click(function() {

                    alert('qwe');


                });

                $('#submit-data').click(function() {
                    var e = document.getElementById('drpappcode');
                    var code = e.options[e.selectedIndex].value;
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
                                url: 'OrganizationCompliance/Add-ajax.php',
                                data: {
                                    _code: code,
                                    _compcode: compcode,
                                    _advname: advname,
                                    _drpyear: drpyear,
                                    _drpcatcode: drpcatcode,
                                    _drpcatname: drpcatname,
                                    _drpcou: drpcourse,
                                    _vision: txtvision,
                                    _mission: txtmission

                                },
                                success: function(response) {

                                    swal("Record Updated!", "The data is successfully Added!", "success");
                                    document.getElementById("form-data").reset();

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
