<!DOCTYPE html>
<html>
<title>OSAS - Applicants</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Accreditation</a></li> </ul></div>";
$currentPage ='OSAS_OrgApplicant';
include('header.php'); 
include('../config/connection.php');
?>
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <!-- Custom styles for this template -->

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
                    <div class="row" id="tableForm">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Applicant <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" href="#Add" class="btn btn-success"> Application <i class="fa fa-plus"></i> </button>
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
                                        <table class="table table-striped table-hover table-bordered" batch-year='<?php echo $current_acadyear; ?>' id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Application Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th>Status</th>
                                                    <th style="width:10%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
														
                                                    $view_query = mysqli_query($con,"SELECT * FROM `r_org_applicant_profile` ");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $code = $row["OrgAppProfile_APPL_CODE"];
                                                        $name = $row["OrgAppProfile_NAME"];
                                                        $desc = $row["OrgAppProfile_DESCRIPTION"];										
                                                        $stat = $row["OrgAppProfile_STATUS"];
                                                        $id = $row["OrgAppProfile_ID"];
                                                        $disstat = $row["OrgAppProfile_DISPLAY_STAT"];
                                                        if($disstat == 'Active'){
                                                            $display = "<center><span class='badge bg-success ' style='padding:10px;'>Active</span></center>";
                                                            $button = "<center>
                                                                            <a class='btn btn-success edit' style='color:white' data-toggle='modal' href='#Add'  href='javascript:;'><i class='fa   fa-edit'></i></a>
                                                                            <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right '></i></a>	
                                                                        </center>";
                                                        }
                                                        else{
                                                            $display = "<center><span class='badge bg-important ' style='padding:10px;'>Inactive</span></center>";
                                                            $button = "<center>
                                                                        <a class='btn btn-info retrieve' href='javascript:;'><i class='fa fa-undo'></i></a>
                                                                    </center>";
                                                        }
                                                            

                                                        echo "
                                                        <tr>
                                                            <td>$code</td>
                                                            <td>$name</td>
                                                            <td>$desc</td>
                                                            <td>$display</td>
                                                            <td style='width:200px'>
                                                                $button
                                                            </td>
                                                        </tr>
                                                                ";
                                                    }	
									       	
									           ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Application Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Organization Description</th>
                                                    <th>Status</th>
                                                    <th style="width:10%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div> <a class='btn btn-cancel tar edit hidden' style='color:white' data-toggle='modal' id="openModalupd" href='#Edit' href='javascript:;'>Profile</a>
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
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Organization Profile</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 form-group" id="formcode"> Organization Application Code
                                <input name="studno" disabled type="text" class="form-control" placeholder="ex. CIT2017" id="txtupdcode"> </div>
                            <div class="col-lg-12 form-group"> Organization Name
                                <input name="emailadd" type="text" class="form-control" placeholder="ex. CIT2017" id="txtname"> </div>
                            <div class="col-lg-12 form-group">
                                <label class="control-label">Organization Category</label>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group" id="course">
                                <label class="control-label">Course</label>
                                <select multiple name="e9" id="e9" style="width:100%" class="populate">
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
                            <div class="col-lg-12 form-group" id="drpnon">
                                <label class="control-label">Non Academic Category</label>
                                <select class="form-control input-sm m-bot15 selectYear" id="nonacad">
                                <option disabled selected>Please select category</option>
                                    <?php

                                        $view_query = mysqli_query($con,"SELECT OrgNonAcad_CODE AS CODE , OrgNonAcad_NAME AS NAME FROM `r_org_non_academic_details` WHERE OrgNonAcad_DISPLAY_STAT = 'Active'");
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group"> Organization Description
                                <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                            </div>
                            <!-- <div class="col-lg-3 form-group hidethis">
                                <input type="checkbox" id="chkacc" name="chkacc" class="checkbox form-control" style="width: 20px">
                                <label for="chkacc">Accredited</label>
                            </div> --></div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="close" class="btn btn-default" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="submit-data" type="button"><u>S</u>ave</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button"><u>S</u>ave</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Student</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="form-data2">
                                    <div class="row" id="profile">
                                        <div class="col-lg-6 form-group"> Organization Name
                                            <input name="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" id="txtupdname"> </div>
                                        <div class="col-lg-6 form-group">
                                            <label class="control-label">Organization Category</label>
                                            <select class="form-control input-sm m-bot15 selectYear" id="upddrpcat">
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
                                        <div class="col-lg-6 form-group" id="updcourse">
                                            <label class="control-label">Course</label>
                                            <select multiple name="e9" id="e9" style="width:100%" class="populate">
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
                                        <div class="col-lg-6 form-group" id="upddrpnon">
                                            <label class="control-label">Non Academic Category</label>
                                            <select class="form-control input-sm m-bot15 selectYear" id="nonacad">
                                                <?php

                                                    $view_query = mysqli_query($con,"SELECT OrgNonAcad_CODE AS CODE , OrgNonAcad_NAME AS NAME FROM `r_org_non_academic_details` WHERE OrgNonAcad_DISPLAY_STAT = 'Active'");
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
                                        <div class="col-lg-12 form-group"> Organization Description
                                            <textarea class="form-control" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtupddesc"></textarea>
                                        </div>
                                        <div class="col-lg-3 form-group hidethis">
                                            <input type="checkbox" id="chkupdacc" name="chkupdacc" class="checkbox form-control" style="width: 20px">
                                            <label for="chkacc">Accredited</label>
                                        </div>
                                    </div>
                                    <input name="studno" type="text" class="form-control hidden" id="txtgetid"> </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button"><u>S</u>ave</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Placed js at the end of the document so the pages load faster -->
        <?php include('footer.php')?>
            <!--script for this page only-->
            <script src="Organization/OrganizationApplicant.js"></script>
            <!-- END JAVASCRIPTS -->
            <script>
                $(document).ready(function () {
                    $('#editable-sample_new').on('click', function () {
                        $('#updsubmit-data').hide();
                        $('#submit-data').show();
                        $("#form-data2").trigger("reset");
                        stat = 'Add';
                    });
                    $('.hidethis').hide();
                    $('#drpnon').hide();
                    $('#upddrpnon').hide();
                    $('#updcourse').hide();
                    $('#formcode').hide();
                    $('#updsubmit-data').hide();
                    $('#drpcat').change(function () {
                        var e = document.getElementById("drpcat");
                        var getcat = e.options[e.selectedIndex].value;
                        console.log();
                        if (getcat == 'ACAD_ORG') {
                            $('#course').show();
                            $('#drpnon').hide();
                        }
                        else if (getcat == 'NON-ACAD_ORG') {
                            $('#course').hide();
                            $('#drpnon').show();
                        }
                        else {
                            $('#course').hide();
                            $('#drpnon').hide();
                        }
                    });
                });
                    EditableTable.init();
            </script>
    </body>

</html>
