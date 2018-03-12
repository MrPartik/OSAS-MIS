<!DOCTYPE html>
<html>

<head>
    <?php include('../header.php');    
$currentPage ='OSAS_OrgApplication'; 
       include('../connection.php');
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
                                            <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success">
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
                                                <th>Application Code</th>
                                                <th>Organization Name</th>
                                                <th>Organization Description</th>
                                                <th>Remarks</th>
                                                <th>Action</th>

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
                                                <td >Remarks</td>
                                                <td style='width:200px'>
                                                    <center>
                                                        <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-edit'></i></a>      
                                                        <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a>	
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
                <a class='btn btn-cancel tar edit hidden' style='color:white' data-toggle='modal' id="openModalupd" href='#Edit' href='javascript:;'>Profile</a>
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
                    <h4 class="modal-title">Organization Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="form-data">
                                <div class="row" id="profile">
                                    <div class="col-lg-6 form-group">
                                        Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. COMMITS Pioneer" id="txtname">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                                    </div>
                                    <div class="col-lg-3 form-group hidethis">
                                        <input type="checkbox" id="chkacc" name="chkacc" class="checkbox form-control" style="width: 20px">
                                        <label for="chkacc">Accredited</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="close" class="btn btn-default" type="button">Close</button>
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
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="form-data2">
                                <div class="row" id="profile">
                                    <div class="col-lg-6 form-group">
                                        Organization Application Code <input name="studno" disabled type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" id="txtupdcode">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        Organization Name<input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdname">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        Organization Description<textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                                    </div>
                                    <div class="col-lg-3 form-group hidethis">
                                        <input type="checkbox" id="chkupdacc" name="chkupdacc" class="checkbox form-control" style="width: 20px">
                                        <label for="chkacc">Accredited</label>
                                    </div>
                                </div>
                                <input name="studno" type="text" class="form-control hidden" id="txtgetid">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
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
    <script src="OrganizationApplication.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('.hidethis').hide();
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
            // // $('#submit-data').click(function() { // // // });

        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
