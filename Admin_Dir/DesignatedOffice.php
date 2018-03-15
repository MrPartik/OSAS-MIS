<!DOCTYPE html>
<html>

<head>
    <title>Admin - Designated Office</title>
    <?php   
$currentPage ='Admin_Designated'; 
include('header.php');  
include('../config/connection.php');
?>
</head>

<body>

    <section id="container">
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
                                            <button id="editable-sample_new" class="btn btn-success add" data-toggle="modal" href="#Add">
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
                                                <th>Office Code</th>
                                                <th>Office Name</th>
                                                <th>Office Description</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							
										$view_query = mysqli_query($con,"select * from `r_designated_offices_details` WHERE DesOffDetails_DISPLAY_STAT = 'Active'");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["DesOffDetails_CODE"];
											$name = $row["DesOffDetails_NAME"];
											$desc = $row["DesOffDetails_DESC"];										
											$id = $row["DesOffDetails_ID"];										
											
											echo "
											<tr class=''>
												<td>$code</td>
												<td>$name</td>
												<td >$desc</td>
												<td style='width:180px'>
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
                                        <tfoot>
                                            <tr>
                                                <th>Office Code</th>
                                                <th>Office Name</th>
                                                <th>Office Description</th>
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
                    <h4 class="modal-title">Add Designated Office</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-data">
                        <div class="row">
                            <header class="panel-heading">
                                Office Code:
                                <asd id='latcode'></asd>
                            </header>
                        </div>
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-6">
                                Office Name <input type="text" class="form-control" placeholder="ex. Library" id="txtname">
                            </div>
                            <div class="col-lg-8 " style="padding-top:10px">
                                Office Description<textarea class="form-control" placeholder="ex. Library" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
                    <button class="btn btn-success " id="submit-data" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Placed js at the end of the document so the pages load faster -->

    <!--script for this page only-->
    <?php include("footer.php") ?>
    <script src="SanctionSetup/DesignatedOffice.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('.add').click(function() {
                $.ajax({
                    type: "GET",
                    url: 'SanctionSetup/DesignatedOffice/GetLatest-Code.php',
                    success: function(data) {
                        document.getElementById('latcode').innerText = data;
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
