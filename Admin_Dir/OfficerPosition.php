<!DOCTYPE html>
<html>

<head>
    <title>OSAS - Organization Category</title>    
<?php include('header.php');    
$currentPage ='Admin_OfficerPos'; 
include('../config/connection.php');
?>

</head>

<body>

    <section id="container">

        <aside>
            <?php
                
                include('sidenav.php')
            
            ?>
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
                                <a class="current" href="#">Officer Position</a>
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
                                            <button data-toggle="modal" href="#myModal" id="" class="btn btn-success">
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
                                                <th>Postion Code</th>
                                                <th>Organization Name</th>
                                                <th>Position Name</th>
                                                <th>Batch Year</th>
                                                <th>Position Description</th>
                                                <th style='width:180px'>Action</th>
                                                <th class='hidden'>ID</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							 
										$view_query = mysqli_query($con,"select * from `r_org_officer_position_details` where OrgOffiPosDetails_DISPLAY_STAT = 'Active'");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["OrgOffiPosDetails_ORG_CODE"];
											$name = $row["OrgOffiPosDetails_NAME"];
											$desc = $row["OrgOffiPosDetails_DESC"];										
											
											echo "
											<tr class=''>
												<td>$code</td>
												<td>$name</td>
												<td >$desc</td>
												<td>
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
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:50%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Officer Position Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label> Position Name</label>
                                <input type="text" placeholder="Enter Position Name" class="form-control" id="txtposname">
                            </div>
                        </div>
                        <div class="row" style="padding-top:15px">
                            <div class="col-lg-6">
                                <label> Organization Name</label>
                                <select class="form-control sm-bot15" id="cmborgname">
                                    <option selected disabled>Please select organization name...</option>

                                    <option>Option 2</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label> Batch Year</label>
                                <select class="form-control sm-bot15" id="cmbyear">
                                    <option selected disabled>Please select batch year...</option>
                                    <?php
                                    
                                        $view_query = mysqli_query($con,"SELECT Batch_YEAR AS YEAR,Batch_CODE as CODE FROM `r_batch_details` ORDER BY `Batch_ID` DESC");
                                        $batchyear = '';
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $year = $row["YEAR"];
                                            $code = $row["CODE"];                                            
                                            $batchyear = $batchyear ."<option value=".$code." >".$year."</option>";
                                        }
                                    
                                        echo $batchyear;
                                    ?>                                
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding-top:15px">
                            <div class="col-lg-12">
                                <label> Position Description</label>
                                <textarea class="form-control" rows="6" id="txtdesc"></textarea>
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

<?php include("footer.php")?>
    <script src="OrganizationSetup/OfficerPosition.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            EditableTable.init();
        });
        $(document).ready(function() {
            $('#submit-data').click(function() {
                var posname = document.getElementById('txtposname').value;
                var orgname = document.getElementById('cmborgname').value;
                var year = document.getElementById('cmbyear').value;
                var desc = document.getElementById('txtdesc').value;

                alert(posname);
                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for Semester",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'OrganizationSetup/OfficerPosition/Add-ajax.php',
                                data: {
                                    _pos: posname,
                                    _org: orgname,
                                    _year: year,
                                    _desc: desc

                                },
                                success: function(response) {
                                    swal("Record Added!", "The data is successfully added!", "success");
                                    oTable.fnDeleteRow(nRow);
                                },
                                error: function(response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    oTable.fnDeleteRow(nRow);
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });


            });

        });

    </script>

</body>

</html>
