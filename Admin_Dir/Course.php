<!DOCTYPE html>
<html>

<head>
    <title>OSAS - Course</title>
    <?php include('header.php');    
$currentPage ='Admin_Course'; 
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
                                <a class="current" href="#">Course</a>
                            </li>
                            <li>
                                <a href="#">Organization Setup</a>
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
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Curriculum Year</th>
                                                <th>Course Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
										$option = 'qwe';
										$getyear = mysqli_query($con,"select * from `r_batch_details` where Batch_DISPLAY_STAT = 'Active' ");

										$view_query = mysqli_query($con,"select * from `r_courses` where Course_DISPLAY_STAT = 'Active'");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["Course_CODE"];
											$name = $row["Course_NAME"];
											$tval = $row["Course_CURR_YEAR"];										
											$desc = $row["Course_DESC"];										
											$id = $row["Course_ID"];										
											
											echo "
											<tr>
												<td>$code</td>
												<td>$name</td>
												<td>$tval</td>	
												<td>$desc</td>	
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
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Curriculum Year</th>
                                                <th>Course Description</th>
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
    <?php

        $getyear = mysqli_query($con,'select * from `r_batch_details` order by Batch_ID desc ');

        while($getrow = mysqli_fetch_assoc($getyear))
        {
            $year = $getrow["Batch_YEAR"];
            $option  = $option . '<option value="'.$year.'">'.$year.'</option>';
        }	

    
    ?>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Course</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-data">
                            <div class="row" style="padding-top:10px">
                                <div class="row" style="padding-left:15px">
                                    <div class="col-lg-4">
                                        Course Code <input type="text" class="form-control" placeholder="ex. BSIT" id="txtcode">
                                    </div>
                                </div>
                                <div class="row" style="padding-top:10px">
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            Course Name <input type="text" class="form-control" placeholder="ex. Bachelor of science in Information Technology" id="txtname">
                                        </div>
                                        <div class="col-lg-4">
                                            Batch Year<select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="selcode"> <?php echo $option; ?></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 " style="padding-top:10px">
                                    Course Description<textarea class="form-control" placeholder="ex. Bachelor of science in Information Technology" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
        <?php include("footer.php") ?>
        <script src="OrganizationSetup/course.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>
            jQuery(document).ready(function() {
                EditableTable.init();
            });

        </script>

</body>

</html>
