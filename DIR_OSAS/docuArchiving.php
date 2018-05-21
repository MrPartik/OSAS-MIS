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
                                <div class="mini-stat-info"> <span><?php echo $count_docu  ?></span> Number of Documents </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-calendar"></i></span>
                                <div class="mini-stat-info"> <span><?php $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `r_system_config` WHERE `SysConfig_NAME` = 'DisposalDays'")); echo $row["SysConfig_PROPERTIES"]?></span>Disposal of Documents (Limitation in (Day/s))</div>
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
                                                    <th>Date Issued</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query = mysqli_query($con,"SELECT `ArchDocuments_ORDER_NO`,`ArchDocuments_NAME`,`ArchDocuments_DESC`,`ArchDocuments_FILE_PATH`,`ArchDocuments_DATE_ADD` FROM `r_archiving_documents`");
                                                            while($row=mysqli_fetch_assoc($query)){?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row['ArchDocuments_ORDER_NO']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['ArchDocuments_NAME']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['ArchDocuments_DESC']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['ArchDocuments_FILE_PATH']?>
                                                        </td>
                                                        <td>
                                                            <?php echo (new datetime($row['ArchDocuments_DATE_ADD']))->format('D M d, Y h:i A')  ?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <button id="btnStudProfile" value="" data-toggle="modal" href="#" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Control Numberr</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>File Name</th>
                                                    <th>Date Issued</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
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
                                    <div class="col-md-12 form-group"> *Document Name
                                        <textarea id="docName" type="text" class="form-control" placeholder="Policy of University/ Branches Required Activity Attendance and Registration Card	" required></textarea>
                                    </div>
                                    <div class="col-md-12 form-group"> *Document Description
                                        <textarea id="docDesc" type="text" class="form-control" placeholder="Requiring the Activity attendance	 " required></textarea>
                                    </div>
                                    <div class="col-md-12 form-group"> *Document File
                                        <input id="docFile" type="file" class="form-control" style=" resize:vertical " required> </div>
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
                    [5, 10, 15, 20, -1]
                    , [5, 10, 15, 20, "All"] // change per page values here
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
                    $("button[name='insert']").on("click", function () {
                        if ($("#docName").val().length && $("#docDesc").val().length && $("#docFile").val().length) {
                            swal({
                                title: "Are you sure?"
                                , text: "This data will be added  and used for further transaction"
                                , type: "warning"
                                , showCancelButton: true
                                , confirmButtonColor: '#9DD656'
                                , confirmButtonText: 'Yes!'
                                , cancelButtonText: "No!"
                                , closeOnConfirm: false
                                , closeOnCancel: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    var file_data = $('#docFile').prop('files')[0]
                                        , form_data = new FormData();
                                    form_data.append('insertDoc', 'insertDoc');
                                    form_data.append('docuName', $("#docName").val());
                                    form_data.append('docuDesc', $("#docDesc").val());
                                    form_data.append('file', file_data);
                                    $.ajax({
                                        url: "docuArchivingSave.php"
                                        , type: "POST"
                                        , data: form_data
                                        , cache: false
                                        , contentType: false
                                        , processData: false
                                        , success: function (data) {
                                            swal({
                                                title: "Woaah, that's neat!"
                                                , text: "The Document record is added"
                                                , type: "success"
                                                , showCancelButton: false
                                                , confirmButtonColor: '#9DD656'
                                                , confirmButtonText: 'Ok'
                                            }, function (isConfirm) {
                                                location.reload();
                                            });
                                        }
                                    });
                                }
                            });
                        }
                        else {
                            swal("Please fill all the required fields", "The transaction is cancelled, please try again", "error");
                        }
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
