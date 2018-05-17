<!DOCTYPE html>
<html>

<head>
    <title>Admin - Batch Year</title>
    <?php   
$currentPage ='Admin_BYear'; 
$breadcrumbs = '<div class="col-md-12  ">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumbs-alt ">
                            <li>
                                <a href="#">Student Setup</a>
                            </li>
                            <li>
                                <a class="current" href="#">Academic Year</a>
                            </li>
                        </ul>
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
                                            <button id="editable-sample_new" class="btn btn-success add" data-toggle="modal" href="#Add"> Add New <i class="fa fa-plus"></i> </button>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>Academic Year </th>
                                                <th>Academic Year Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							
										$view_query = mysqli_query($con,"select * from `r_batch_details` ");
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["Batch_CODE"];
											$name = $row["Batch_YEAR"];
											$desc = $row["Batch_DESC"];										
											$id = $row["Batch_ID"];										
											$stat = $row["Batch_DISPLAY_STAT"];										
                                            
                                            echo "
											<tr class=''>
												<td idAcadY='$id' >$name</td>
												<td >$desc</td> 
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
                                                <th>Academic Year </th>
                                                <th>Academic Year Description</th>
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
        <div class="modal-dialog" style=" width:700px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Academic Year</h4> </div>
                <div class="modal-body">
                    <form method="post" id="form-data">
                        <div class="row">
                            <header class="panel-heading"> Batch Code:
                                <asd id='latcode'></asd>
                            </header>
                        </div>
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-12"> Batch Year
                                <input type="text" class="form-control" placeholder="ex. 2018-2019" id="txtname"> </div>
                            <div class="col-lg-12" style="padding-top:10px"> Batch Description
                                <textarea class="form-control" placeholder="ex. Batch Description" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
        <script src="StudentSetup/BatchYear.js"></script>
        <!-- END JAVASCRIPTS -->
        <script>
            $(document).ready(function () {
                $('.add').click(function () {
                    $.ajax({
                        type: "GET"
                        , url: 'StudentSetup/BatchYear/GetLatest-Code.php'
                        , success: function (data) {
                            document.getElementById('latcode').innerText = data;
                        }
                    });
                });
            });
            jQuery(document).ready(function () {
                $('#btnprint').on('click', function () {
                    var items = [];
                    var rows = $('#editable-sample').dataTable().$('tr', {
                        "filter": "applied"
                    });
                    $(rows).each(function (index, el) {
                        items.push($(this).closest('tr').children('td:first').text());
                    })
                    window.open('Print/AcademicYear_Print.php?items=' + items, '_blank');
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
