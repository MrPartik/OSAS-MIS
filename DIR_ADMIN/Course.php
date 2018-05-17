<!DOCTYPE html>
<html>

<head>
    <title>Admin - Course</title>
    <?php 
$currentPage ='Admin_Course'; 
$breadcrumbs = '<div class="col-md-12  ">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumbs-alt ">
                            <li>
                                <a  href="#">Organization Setup</a>
                            </li>
                            <li>
                                <a class="current" href="#">Course</a>
                            </li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
';
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
                                            <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
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

										$view_query = mysqli_query($con,"select * from `r_courses` ");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["Course_CODE"];
											$name = $row["Course_NAME"];
											$tval = $row["Course_CURR_YEAR"];										
											$desc = $row["Course_DESC"];										
											$id = $row["Course_ID"];										
											$stat = $row["Course_DISPLAY_STAT"];										
											
                                            
                                            
                                            echo "											
                                                <tr>
                                                    <td>$code</td>
                                                    <td>$name</td>
                                                    <td>$tval</td>	
                                                    <td>$desc</td>	
                                                ";
                                            if($stat == 'Active')
                                            {

                                                echo "										
                                                        <td style='width:180px'>
                                                            <center>
                                                                <a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a>
                                                                <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a>	
                                                            <center>
                                                        </td>

                                                    </tr>
                                                    ";

                                            }
                                            else
                                            {

                                                echo "										
                                                        <td style='width:180px'>
                                                            <center>
                                                                <a class='btn btn-info retrieve' href='javascript:;'><i class='fa fa-rotate-left'></i></a>	
                                                            <center>
                                                        </td>

                                                    </tr>
                                                    ";


                                            }
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
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Course</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form-data">
                            <div class="row" style="padding-top:10px">
                                <div class="row" style="padding-left:15px">
                                    <div class="col-lg-12">
                                        Course Code <input type="text" class="form-control" placeholder="ex. BSIT" id="txtcode">
                                    </div>
                                </div>
                                <div class="row" style="padding-top:10px">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            Course Name <input type="text" class="form-control" placeholder="ex. Bachelor of science in Information Technology" id="txtname">
                                        </div>
                                        <div class="col-lg-12">
                                            Academic Year<select class="form-control input-sm m-bot15 selectYear" style="width:100%" id="selcode"> 
                                            <option selected disabled>Please Select Academic Year</option>
                                            <?php echo $option; ?></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 " style="padding-top:10px">
                                    Course Description<textarea class="form-control" placeholder="ex. Bachelor of science in Information Technology" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="close" type="button"><u>C</u>lose</button>
                        <button class="btn btn-success " id="submit-data" type="button"><u>S</u>ave</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php") ?>
        <script src="OrganizationSetup/course.js"></script>

        <!-- END JAVASCRIPTS -->
        <script>
            jQuery(document).ready(function() {
                $('#btnprint').click(function() {

                    var items = [];
                    var rows = $('#editable-sample').dataTable()
                        .$('tr', {
                            "filter": "applied"
                        });
                    $(rows).each(function(index, el) {
                        items.push($(this).closest('tr').children('td:first').text());

                    })

                    window.open('Print/Course_Print.php?items=' + items, '_blank');
                });
                document.onkeyup = function(e) {
                if (e.altKey && e.which == 83) {
                    if($('#Add').is(':visible')){
                        $('#submit-data').click();
                    }
                } else if (e.altKey && e.which == 67) {
                    if($('#Add').is(':visible')){
                        $('#close').click();
                    }
                } 
            };
                EditableTable.init();
            });

        </script>

</body>

</html>
