<!DOCTYPE html>
<html>

<head>
    <title>Admin - Accreditation Requirement</title>
    <?php
$currentPage ='Admin_AccrReq';
include('header.php');
include('../config/connection.php');
?>
</head>

<body>

    <section id="container">
        <aside>
            <div id="sidebar" class="nav-collapse">
                <?php include('sidenav.php')   ?>
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
                                                <th>Requirement Code</th>
                                                <th>Requirement Name</th>
                                                <th>Requirement Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							 
                                                $view_query = mysqli_query($con,"select * from `r_org_accreditation_details` where OrgAccrDetail_DISPLAY_STAT = 'Active'");
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $code = $row["OrgAccrDetail_CODE"];
                                                    $name = $row["OrgAccrDetail_NAME"];
                                                    $desc = $row["OrgAccrDetail_DESC"];										
                                                    $id = $row["OrgAccrDetail_ID"];										

                                                    echo "
                                                    <tr class=''>
                                                        <td>$code</td>
                                                        <td>$name</td>
                                                        <td >$desc</td>
                                                        <td style='width:150px'>
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
                                                <th>Requirement Code</th>
                                                <th>Requirement Name</th>
                                                <th>Requirement Description</th>
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
                    <h4 class="modal-title">Add Accreditation Requirement</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-data">
                        <div class="row">
                            <header class="panel-heading">
                                Requirement Code:
                                <asd id='latcode'></asd>
                            </header>
                        </div>
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-6">
                                Accreditation Requirement Name <input type="text" class="form-control" placeholder="ex. Organization Name" id="txtreqname">
                            </div>
                            <div class="col-lg-8 " style="padding-top:10px">
                                Accreditation Requirement Description<textarea class="form-control" placeholder="ex. Every organization must have unique name" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtreqdesc"></textarea>
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

    <?php include("footer.php") ?>
    <!--Core js-->

    <!--script for this page only-->
    <script src="OrganizationSetup/AccreditationRequirement.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#btnprint').click(function() {
                var items = [];
                var table = $('#editable-sample').DataTable();
                jQuery(table.fnGetNodes()).each(function() {
                    items.push($(this).closest('tr').children('td:first').text());
                });
                window.open('Print/AccreditationRequirement_Print.php?items=' + items, '_blank');
            });
            $('.add').click(function() {
                $.ajax({
                    type: "GET",
                    url: 'OrganizationSetup/AccreditationRequirement/GetLatest-Code.php',
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
