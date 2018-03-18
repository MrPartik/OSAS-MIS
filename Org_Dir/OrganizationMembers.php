<!DOCTYPE html>
<html>
<title>OSAS - Organization Members</title>
<?php 
$breadcrumbs="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a class='current' href='OrganizationMembers.php'>Organization Members</a></li>
</ul>
</div>"; 
$currentPage ='OSAS_OrgMem'; 
//ANDTIOOOOOOO    
include('header.php'); 
$compcode = $referenced_user;
include('../config/connection.php');
?>
<link href="../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="../js/data-tables/DT_bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../js/bootstrap-fileupload/bootstrap-fileupload.css" />
<!-- Custom styles for this template -->
<link href="../css/style.css" rel="stylesheet">
<link href="../css/style-responsive.css" rel="stylesheet" />

<body>
    <section id="container">
        <!--header end-->
        <?php include('sidenav.php')?>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading"> Organization Members <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <div class="col-lg-12">
                                            <button id="editable-sample_new" data-toggle="modal" href="#Add" class="btn btn-success">
                                        Add <i class="fa fa-plus"></i>
                                        </button>
                                            <button class='btn btn-primary ' id="btnsync">Sync <i class='fa fa-refresh' ></i></button>

                                            <class id="getappcode"><?php echo $referenced_user;?></class>

                                        </div>
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
                                <div class="adv-table editable-table ">
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>Student Number</th>
                                                <th>Student Name</th>
                                                <th>Course - Year and Section</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                   
                                                    $view_query = mysqli_query($con,"SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS, IFNULL((SELECT OrgOffiPosDetails_NAME FROM r_org_officer_position_details 
		INNER JOIN t_org_officers ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
 	WHERE OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffi_STUD_NO = Stud_NO  AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$compcode' AND OrgForCompliance_DISPAY_STAT = 'Active')   ),'Member') AS POS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        LEFT JOIN t_org_officers  ON OrgOffi_STUD_NO = AssOrgMem_STUD_NO       
        LEFT JOIN r_org_officer_position_details ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
        WHERE AssOrgMem_DISPLAY_STAT = 'Active'  AND AssOrgMem_COMPL_ORG_CODE = '$compcode'"
                                                    );
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $snum = $row["Stud_NO"];
                                                        $sname = $row["NAME"];
                                                        $cas = $row["CAS"];
                                                        $pos = $row["POS"];
                                                        echo "
                                                            <tr>
                                                                <td>$snum</td>
                                                                <td>$sname</td>
                                                                <td>$cas</td>
                                                                <td>$pos</td>
                                                                <td><center><a class='btn btn-success edit' data-toggle='modal'  href='#Edit'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center></td>
                                                            </tr>
                                                                ";
                                                    }



                                            ?>
                                        </tbody> <tfoot>
                                            <tr>
                                                <th>Student Number</th>
                                                <th>Student Name</th>
                                                <th>Course - Year and Section</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                                </tfoot>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <form id="upload_csv" method="post" enctype="multipart/form-data">
                                        <div class="controls col-md-12">
                                            <div class="fileupload fileupload-new row" data-provides="fileupload"> <span class="btn btn-white btn-file" style="width:200px">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Click to Import Members</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input name="employee_file" id="file" type="file" class="default" accept=".csv" /> </span> <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                <button type="submit" class='btn btn-success' id="upload">Import <i class='fa fa-cloud-upload'></i></button>
                                            </div>
                                        </div>
                                    </form>
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
        <div class="modal-dialog" style="width:40%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Organization Members</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <form method="post" id="form-data">
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-lg-12"> Student Name
                                                <select class="form-control input-sm m-bot15 selectAppCode" style="width:100%" id="drpstud">

                                                </select>
                                            </div>
                                            <div class="col-lg-12"> Position
                                                <select class="form-control input-sm m-bot15 " style="width:100%" id="drppos">
                                                        <option value="default" selected>Member</option>
                                                         <?php
                                                   
                                                     $view_query = mysqli_query($con," SELECT OrgOffiPosDetails_ID,OrgOffiPosDetails_NAME FROM `r_org_officer_position_details`
                                                        WHERE OrgOffiPosDetails_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$compcode' AND OrgForCompliance_DISPAY_STAT = 'Active') AND OrgOffiPosDetails_DISPLAY_STAT = 'Active'  ");                                                   
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $id = $row['OrgOffiPosDetails_ID'];
                                                        $name = $row['OrgOffiPosDetails_NAME'];
                                                        echo " <option value='".$id."' >".$name."</option>";

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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
                    <button class="btn btn-success " id="submit-data" type="button">Save</button>
                </div>

            </div>
        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
        <div class="modal-dialog" style="width:40%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Organization Members</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <form method="post" id="updform-data">
                                        <div class="row" style="padding-top:10px">
                                            <div class="col-lg-12">
                                                <label for="upddrpstud">Student Name</label>
                                                <br/>
                                                <span class="label label-primary" id="updstudname" style="font-size:12px">Primary</span>
                                                <span class="label label-primary" id="updstudnum" style="font-size:12px">Primary</span>

                                            </div>
                                            <div class="col-lg-12" style="padding-top:5px"> Position
                                                <select class="form-control input-sm m-bot15 " style="width:100%" id="upddrppos">
                                                        <option value="default" selected>Member</option>
                                                         <?php
                                                   
                                                     $view_query = mysqli_query($con," SELECT OrgOffiPosDetails_ID,OrgOffiPosDetails_NAME FROM `r_org_officer_position_details`
                                                        WHERE OrgOffiPosDetails_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$compcode' AND OrgForCompliance_DISPAY_STAT = 'Active') AND OrgOffiPosDetails_DISPLAY_STAT = 'Active'  ");                                                   
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $id = $row['OrgOffiPosDetails_ID'];
                                                        $name = $row['OrgOffiPosDetails_NAME'];
                                                        echo " <option value='".$id."' >".$name."</option>";

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
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
                    <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                </div>

            </div>
        </div>
    </div>
    <!-- modal -->
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
    <script src="../bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../js/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="../js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../js/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <!--common script init for all pages-->
    <script src="../js/scripts.js"></script>
    <!--script for this page only-->
    <script src="OrganizationMembers/OrganizationMembers.js"></script>
    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#getappcode').hide();
            $('#updstudnum').hide();
            var countreq = 0;
            var flag = 0;
            $('#upload_csv').on("submit", function(e) {
                var orgcode = document.getElementById('getappcode').innerText;
                e.preventDefault();
                $.ajax({
                    url: "OrganizationMembers/Export_Members.php?Orgcode=" + orgcode,
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    success: function(data) {
                        if (data == 'Error1') {
                            swal("Invalid File");
                        } else if (data == "Error2") {
                            swal("Cancelled", "Please Select File", "error");
                        } else {
                            $.each(data, function(key, val) {
                                //alert(val.snum)
                            });

                            swal("Record Updated!", "The data is successfully imported!", "success");
                        }
                    }
                })
            });
            $('#drpappcode').change(function() {
                //                alert('qwe');
                var _drpappcode = document.getElementById('drpappcode');
                var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _code: drpcode
                    },
                    success: function(data) {
                        //                        alert(data.count);
                        countreq = data.countlist;
                        document.getElementById('accreqlist').innerHTML = data.list;
                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });

        });
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>
</body>

</html>
