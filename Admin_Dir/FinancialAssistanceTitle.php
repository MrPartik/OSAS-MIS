<!DOCTYPE html>
<html>

<head>
    <title>Admin - Financial Assistance Title</title>
    <?php  
$currentPage ='Admin_Title'; 
include('header.php');  
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
                                <a class="current" href="#">Financial Assistance Title</a>
                            </li>
                            <li>
                                <a href="#">Student Setup</a>
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
                                            <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>Title Code</th>
                                                <th>Title Name</th>
                                                <th>Title Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
								$view_query = mysqli_query($con,"select * from `r_financial_assistance_title` where FinAssiTitle_DISPLAY_STAT = 'Active' ");
								while($row = mysqli_fetch_assoc($view_query))
								{
									$code = $row["FinAssiTitle_CODE"];
									$name = $row["FinAssiTitle_NAME"];
									$desc = $row["FinAssiTitle_DESC"];										
									$id = $row["FinAssiTitle_ID"];										
									
									echo "
									<tr>
										<td>$code</td>
										<td>$name</td>
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
                                                <th>Title Code</th>
                                                <th>Title Name</th>
                                                <th>Title Description</th>
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
                    <h4 class="modal-title">Add Financial Assistance Title</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-data">
                        <div class="row">
                            <header class="panel-heading">
                                Title Code:
                                <asd id='latcode'></asd>
                            </header>
                        </div>
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-6">
                                Title Name <input type="text" class="form-control" placeholder="ex. CHED" id="txtname">
                            </div>
                            <div class="col-lg-8 " style="padding-top:10px">
                                Title Description<textarea class="form-control" placeholder="ex. Commission on Higher Education of the Philippines" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
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
    <?php include("footer.php")?>
    <script src="StudentSetup/Title.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#btnprint').click(function() {

                var items = [];
                var table = $('#editable-sample').DataTable();
                jQuery(table.fnGetNodes()).each(function() {
                    items.push($(this).closest('tr').children('td:first').text());
                });
                window.open('Print/AssistanceTitle_Print.php?items=' + items, '_blank');
            });
            $('.add').click(function() {
                $.ajax({
                    type: "GET",
                    url: 'StudentSetup/Title/GetLatest-Code.php',
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
