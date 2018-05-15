
<!DOCTYPE html>
<html>
<title>OSAS - Student Profile</title>
<?php 
$breadcrumbs = "<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='docuArchiving.php' class='current'>Document Archiving</a> </li> 
</ul>
</div>"; 
$currentPage ='OSAS_docuArchive';  
include('header.php'); 
include('../config/connection.php');
?>

    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row ">
                        <!-- <div class="col-md-12">
                            <ul class="breadcrumbs-alt">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a href="docuArchiving.php" class="current">Document Archiving</a> </li> 
                            </ul>
                        </div> -->
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-envelope"></i></span>
                                <div class="mini-stat-info"> <span>1</span> Number of Documents </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <section class="panel">
                                <header class="panel-heading"> Student Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <button data-toggle="modal" href="#Add" class="btn btn-default"> <i class="fa fa-plus"></i> Add</button>
                                    <div class="adv-table" id="TableStudProfile">
                                        <table class="display table table-bordered table-striped col-md-12" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Control Number</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>File Name</th>
                                                    <th>Last Modified</th>
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>
                                                            2017-doc-0001
                                                            </td>
                                                            <td>  
                                                            Policy of University/ Branches Required Activity Attendance and Registration Card
                                                            </td>
                                                            <td> 
                                                            Requiring the Activity attendance
                                                            </td>
                                                            <td> 
                                                            PolUniv.docx
                                                            </td>
                                                            <td> 
                                                                Wed Feb 28, 2018 11:30 PM
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <button id="btnStudProfile" value="" data-toggle="modal" href="#" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
                                                                </center>
                                                            </td>
                                                        </tr> 
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Control Numberr</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>File Name</th>
                                                    <th>Last Modified</th>
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
                <div class="modal-dialog" style="width:700px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Archive Document</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now archiving a document</p>
                            <br>
                            <div class="row">
                                <div class="col-md-12 form-group"> 
                                <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
                            <div id="drop">
                                Drop Here

                                <a>Browse</a>
                                <input type="file" name="upl" multiple />
                            </div>

                            <ul>
                                <!-- The file uploads will be shown here -->
                            </ul>

                        </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button name="insert" class="btnInsert btn btn-success" type="submit">Submit</button>
                                <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
            <div id="Profile" class="modal fade content-profile" role="dialog"> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?> 
                <script>
                                var oTable = $('#dynamic-table').dataTable({
                        "aLengthMenu": [
                    [5, 10,15, 20, -1]
                    , [5, 10,15, 20, "All"] // change per page values here
                ], // set the initial value
                        "iDisplayLength": 10
                        , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                        , "sPaginationType": "bootstrap"
                        , "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page"
                            , "oPaginate": {
                                "sPrevious": "Prev"
                                , "sNext": "Next"
                            }
                        }
                        , aaSorting: [[4, "desc"]]
                    });
                    $("#TableStudProfile").on("click", "#btnStudProfile", function () {
                        var datas = $(this).attr("value");
                        $.ajax({
                            url: "studProfileModal.php?StudID=" + datas
                            , cache: false
                            , async: false
                            , success: function (result) {
                                $(".content-profile").html(result);
                            }
                        });
                    });
                </script>
    </body>
    
</html>
