<!DOCTYPE html>
<html>

<head>
    <?php include('../header.php');    
    $currentPage ='OSAS_OrgMembers'; 
   include('../connection.php');
?>
    <link href="../../../js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../../../js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../js/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../../js/bootstrap-fileupload/bootstrap-fileupload.css" />

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
                                <a class="current" href="#">Organization Members</a>
                            </li>
                            <li>
                                <a href="#">Organization Management</a>
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
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th class='hidden'>Organization Code</th>
                                                <th>Organization Name</th>
                                                <th>Organization Category</th>
                                                <th>Number of Members</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							
										include('../connection.php');
                
                                        $view_query = mysqli_query($connection,"SELECT OrgForCompliance_OrgApplProfile_APPL_CODE,OrgAppProfile_NAME,OrgForCompliance_ADVISER,OrgAppProfile_STATUS,OC.OrgCat_NAME,(SELECT COUNT(*) FROM t_assign_org_members WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND AssOrgMem_APPL_ORG_CODE = OAP.OrgAppProfile_APPL_CODE) AS COU
FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE INNER JOIN t_assign_org_category AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE INNER JOIN r_org_category OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE 
WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active'");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["OrgForCompliance_OrgApplProfile_APPL_CODE"];
                                            $name = $row["OrgAppProfile_NAME"];
                                            $cat = $row["OrgCat_NAME"];
                                            $cou = $row["COU"];
                                            $i = 0;
                                             
                                            
                                            echo "
                                            <tr class=''>
                                                <td class='hidden'>$code</td>
                                                <td>$name</td>
                                                <td>$cat</td>
                                                <td>$cou</td>
                                                <td style='width:100px'>
                                                    <center><a class='btn btn-cancel tar edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-eye'></i> </a>
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
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
        <div class="modal-dialog" style="width:70%">
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
                                    <div class="row" id="profile">
                                        <div class="col-lg-12 form-group">
                                            Organization Name
                                            <h4 id="orgname">asd </h4>
                                            <h4 id="orgcode">asd </h4>
                                        </div>
                                        <div class="clearfix">
                                            <div class="btn-group">
                                                <button id="btnstudadd" class="btn btn-success">
                                                        Add <i class="fa fa-plus"></i>
                                                    </button>
                                                <a class='btn btn-primary delete tooltips' id="btnsync" data-toggle='tooltip' href='javascript:;' data-placement='bottom' data-original-title='Sync the data? '>Sync <i class='fa fa-refresh' ></i></a>
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
                                        <div id="drpstudent">
                                            <br/> Student Name
                                            <select class="form-control input-sm m-bot15 selectAppCode" style="width:100%" id="drpstud"> 
                                                    <option selected disabled>Choose Student...</option>
                                                    <?php

                                                        $view_query = mysqli_query($connection,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE NOT IN (SELECT DISTINCT OrgAccrProcess_ORG_CODE FROM `t_org_accreditation_process` WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' )
                                                        ");
                                                        while($row = mysqli_fetch_assoc($view_query))
                                                        {
                                                            $name = $row["OrgAppProfile_NAME"];
                                                            $code = $row["OrgForCompliance_ORG_CODE"];

                                                            echo "
                                                                <option value='$code'>$name</option>
                                                                    ";
                                                        }	



                                                    ?>  
                                            </select>
                                            <div class="pull-right">
                                                <button id="btnaddstud" class="btn btn-success">
                                                        Add <i class="fa fa-plus"></i>
                                                </button>
                                                <button id="btncancel" class="btn btn-cancel">
                                                        Cancel <i class="fa fa-ban"></i>
                                                </button>
                                            </div>


                                        </div>
                                        <form method="post" id="form-data">
                                            <div class="adv-table proftable ">
                                                <div class="space15"></div>
                                                <table class="table table-striped table-hover table-bordered" id="proftable">
                                                    <thead>
                                                        <tr>
                                                            <th>Student Number</th>
                                                            <th>Student Name</th>
                                                            <th>Course - Year and Section</th>
                                                            <th id="hideaction">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="updaccreqlist">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <form id="upload_csv" method="post" enctype="multipart/form-data">
                                                <div class="controls col-md-12">
                                                    <div class="fileupload fileupload-new row" data-provides="fileupload">
                                                        <span class="btn btn-white btn-file" style="width:200px">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Click to Import Members</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="employee_file" id="file" type="file" class="default" accept=".csv" />
                                                        </span>
                                                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        <button type="submit" class='btn btn-success' id="upload">Import <i class='fa fa-cloud-upload' ></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form id="upload_csv2" method="post" enctype="multipart/form-data">
                                                <div class="controls col-md-12">
                                                    <div class="fileupload fileupload-new row" data-provides="fileupload">
                                                        <span class="btn btn-white btn-file" style="width:200px">
                                                        <span class="fileupload-new" ><i class="fa fa-paper-clip"></i>Click to Import Officers   </span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="employee_file2" id="file2" type="file" class="default" accept=".csv" />
                                                        </span>
                                                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        <button type="submit" class='btn btn-primary' id="upload2">Import <i class='fa fa-cloud-upload' ></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->

    <script type="text/javascript" src="../../../js/jquery-2.2.3.min.js"></script>

    <script src="../../../bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../../js/jquery.scrollTo.min.js"></script>
    <script src="../../../js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../../../js/jquery.nicescroll.js"></script>

    <script type="text/javascript" src="../../../js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../../../js/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../../js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../../js/bootstrap-fileupload/bootstrap-fileupload.js"></script>


    <!--common script init for all pages-->
    <script src="../../../js/scripts.js"></script>

    <!--script for this page only-->
    <script src="OrganizationMembers.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $('#orgcode').hide();
        $('#btnsync').hide();
        $('#drpstudent').hide();


        $(document).ready(function() {
            var countreq = 0;
            var flag = 0;


            $('#upload_csv').on("submit", function(e) {
                e.preventDefault(); //form will not submitted  

                $.ajax({
                    url: "OrganizationMembers/Export_Members.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false, // The content type used when sending data to the server.  
                    cache: false, // To unable request pages to be cached  
                    processData: false, // To send DOMDocument or non processed data file it is set to false  
                    success: function(data) {
                        if (data == 'Error1') {
                            swal("Invalid File");
                        } else if (data == "Error2") {
                            swal("Cancelled", "Please Select File", "error");
                        } else {
                            alert(data);
                            //                            $.each(data, function(key, val) {
                            //
                            //                                alert('qwe');
                            //                            });
                            swal("Record Updated!", "The data is successfully imported!", "success");
                        }
                    }
                })

            });
            $('#upload_csv2').on("submit", function(e) {
                e.preventDefault(); //form will not submitted  

                $.ajax({
                    url: "OrganizationMembers/Export_Officers.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false, // The content type used when sending data to the server.  
                    cache: false, // To unable request pages to be cached  
                    processData: false, // To send DOMDocument or non processed data file it is set to false  
                    success: function(data) {
                        if (data == 'Error1') {
                            swal("Invalid File");
                        } else if (data == "Error2") {
                            swal("Cancelled", "Please Select File", "error");
                        } else {
                            alert(data);
                            //                            $.each(data, function(key, val) {
                            //
                            //                                alert('qwe');
                            //                            });
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
                    url: 'OrganizationMembers/GetData-ajax.php',
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


            $('#btnstudadd').click(function() {
                $('#drpstudent').show(800);
                $('#btnstudadd').hide();

            });

            $('#btncancel').click(function() {
                $('#drpstudent').hide(800);
                $('#btnstudadd').show(800);


            });
            $('#btnimports').click(function() {
                alert(document.getElementById("file").value);

                /*
                $.ajax({
                    type: 'POST',
                    url: 'OrganizationMembers/import.php',
                    data: {
                        _t: 'asd'

                    },
                    success: function(response) {
                        swal("Record Updated!", "The data is successfully Added!", "success");
                        //document.getElementById("form-data").reset();
                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
                */
            });

            $('#submit-data').click(function() {
                var _drpappcode = document.getElementById('drpappcode');
                var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                var accstat = '';
                var chkstat = '';
                var chkcode = '';
                var stat = 0;

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

                        for (x = 1; x <= countreq; x++) {
                            chkstat = document.getElementById('chkstat' + x);
                            if (chkstat.checked)
                                stat = 1;
                            else
                                stat = 0;

                            reccode = document.getElementById('code' + x).innerText;


                            $.ajax({
                                type: 'post',
                                url: 'OrganizationAccreditation/AccReq-ajax.php',
                                data: {
                                    _drpcode: drpcode,
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
                var compcode = document.getElementById('orgcode').innerText;
                var accstat = '';
                var chkstat = '';
                var chkcode = '';
                var stat = 0;

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
                        //
                        //                        for (x = 1; x <= </?php echo $i; ?>; x++) {
                        //                            chkstat = document.getElementById('chkupdstat' + x);
                        //                            if (chkstat.checked)
                        //                                stat = 1;
                        //                            else
                        //                                stat = 0;
                        //                            reccode = document.getElementById('updcode' + x).innerText;
                        //
                        //                            $.ajax({
                        //                                type: 'post',
                        //                                url: 'OrganizationAccreditation/UpdAccReq-ajax.php',
                        //                                data: {
                        //                                    _compcode: compcode,
                        //                                    _reccode: reccode,
                        //                                    _stat: stat
                        //
                        //                                },
                        //                                success: function(response) {
                        //                                    swal("Record Updated!", "The data is successfully Added!", "success");
                        //                                    //document.getElementById("form-data").reset();
                        //                                },
                        //                                error: function(response) {
                        //                                    swal("Error encountered while adding data", "Please try again", "error");
                        //                                }
                        //                            });
                        //                        }

                    } else swal("Cancelled", "The transaction is cancelled", "error");
                });

            });
        });
        jQuery(document).ready(function() {
            initproftable.init();
            EditableTable.init();

        });

    </script>


</body>

</html>
