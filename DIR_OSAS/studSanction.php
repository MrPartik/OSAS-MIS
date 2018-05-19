<!DOCTYPE html>
<html>
<title>OSAS - Student Sanction</title>
<?php 
$breadcrumbs ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href=#'>Student Management</a> </li>
    <li> <a class='current' href='studSanction.php'>Student Sanction</a> </li>
</ul>
</div>"; 
$currentPage ='OSAS_StudSanction';     
include('header.php'); 
include('../config/connection.php');
?>
<link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-user"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_sanction?></span> Number of Students who has Sanction </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Sanction Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div id="TableStudSanc" class="panel-body">
                                    <button data-toggle="modal" href="#AddSanc" class="btn btn-default"> <i class="fa fa-plus"></i> Sanction</button>
                                    <button data-toggle="modal" href="#AddDest" class="btn  btn-default"> <i class="fa fa-plus"></i> Office Destination</button>
                                    <div class="adv-table">
                                        <table class="display table table-bordered table-striped" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th width="15%">Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course</th>
                                                    <th style="width:10%">Status</th>
                                                    <th>Progress</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php   while($stud_row=mysqli_fetch_array($view_studProfile)) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $stud_row['Stud_NO'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['FullName'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['Course']?>
                                                        </td>
                                                        <td>
                                                            <?php  
                                                            $studNo = $stud_row['Stud_NO'];
                                                            $noRow = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = '$studNo' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished'), (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE= b.SancDetails_CODE WHERE a.AssSancStudStudent_STUD_NO  = '$studNo' and a.AssSancStudStudent_IS_FINISH ='finished' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive' )")); ?>
                                                                <center> <span class="label label-danger label-mini"> <?php echo $noRow[0] ?>  </span> &nbsp; <span class="label label-success label-mini"> <?php echo $noRow[1] ?>  </span> </center>
                                                        </td>
                                                        <?php
                                                viewStudSanctionComputation($stud_row['Stud_NO']);
                                                $row=mysqli_fetch_array($view_studSanctionComputation) 
                                                ?>
                                                            <td style="width:20%;" title="<?php echo $row['Percentage'] ?>"> <span class="hidden"><?php echo $row['Percentage'] ?></span>
                                                                <div class="progress progress-striped progress-xs">
                                                                    <div style="width:<?php echo $row['Percentage'] ?>%" aria-valuemax="100%" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success"> <span class="sr-only">40% Complete (success)</span> </div>
                                                                </div>
                                                            </td>
                                                            <?php   
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysqli_fetch_array(mysqli_query($con,"select max(AssSancStudStudent_DATE_MOD) from t_assign_stud_saction where AssSancStudStudent_STUD_NO ='$StudNo'"));?>
                                                                <td data-order="<?php   echo  ($row[0]==null )?" ":($row[0]); ?>">
                                                                    <?php   echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A'); ?>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <button id="StudSanctionModalClick" value="<?php echo $stud_row['Stud_NO']; ?>" class="btn btn-info " data-toggle="modal" href="#studSanction"> <i class="fa  fa-info-circle"></i> </button>
                                                                    </center>
                                                                </td>
                                                    </tr>
                                                    <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course</th>
                                                    <th style="width:10%">Status</th>
                                                    <th>Progress</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="btn-group">
                                            <form id="upload_csv" method="post" enctype="multipart/form-data">
                                                <div class="controls col-md-12">
                                                    <div class="fileupload fileupload-new row" data-provides="fileupload"> <span class="btn btn-white btn-file" style="width:200px">
                                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Click to Import Members</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="employee_file" id="file" type="file" class="default" accept=".csv" /> </span> <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        <button type="submit" class='btn btn-success' id="upload">Import <i class='fa fa-cloud-upload'></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
            <!-- Modal Sanction-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddSanc" class="modal fade">
                <div class="modal-dialog" style="width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Add Sanction Details</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now adding sanction data</p>
                            <br>
                            <div class="row">
                                <div class="col-md-6 form-group"> *Sanction Code
                                    <input title="sanction code is depending on the sanction description, it is a short description for the sanction" id="sancCode" type="text" class="form-control" placeholder="ex. 2.1 3rdOffense" required/> </div>
                                <div class="col-md-6 form-group"> *Sanction Time Interval
                                    <input title="sanction time interval must in hours format" id="sancTime" type="number" class="form-control" placeholder="ex. 42" required/> </div>
                                <div class="col-md-12 form-group"> *Sanction Name
                                    <textarea title="sanction name" id="sancName" type="text" class="form-control" style="resize:vertical" placeholder="ex. 3rd Offense Failure to bring valid ID" required></textarea>
                                </div>
                                <div class="col-md-12 form-group"> *Sanction Description
                                    <textarea id="sancDesc" type="text" class="form-control" placeholder="ex. 2.1 failure to bring valid ID in case the student can present his/her registration certificate" style=" resize:vertical " required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button class="btnInsertSanc btn btn-success " type="submit ">Submit</button>
                                <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Sanction-->
            <!-- Modal Dest-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddDest" class="modal fade">
                <div class="modal-dialog" style="width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Add Available Offices</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now adding available offices data</p>
                            <br>
                            <div class="row">
                                <div class="col-md-12 form-group"> *Office Code
                                    <input title="office code is depending on the office description, it is a short description for the designated office of the student who has sanction" id="OffCode" type="text" class="form-control" placeholder="ex. Lib" required/> </div>
                                <div class="col-md-12 form-group"> *Office Name
                                    <textarea title="Office name" id="OffName" type="text" class="form-control" style="resize:vertical" placeholder="ex. Liibrary" required></textarea>
                                </div>
                                <div class="col-md-12 form-group"> *Office Description
                                    <textarea id="OffDesc" type="text" class="form-control" placeholder="ex. A school library is a library within a school where students, staff, and often, parents of a public or private school have access to a variety of resources." style=" resize:vertical " required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button class="btnInsertOff btn btn-success " type="submit ">Submit</button>
                                <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Dest-->
            <div id="studSanction" class="modal fade content-sanction " role="dialog "> </div>
            <!--Core js-->
            <?php include('footer.php')?> <script type="text/javascript" src="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script>
        $(document).ready(function() {
            $('#getappcode').hide();
            $('#updstudnum').hide();
            var countreq = 0;
            var flag = 0;
            $('#upload_csv').on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "Student/export_stud_sanction.php",
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
                                swal({
                                    title: "Data Imported!",
                                    text: "The csv file is successfully imported!",
                                    type: "success",
                                    confirmButtonColor: '#88A755',
                                    confirmButtonText: 'Okay',
                                    closeOnConfirm: false
                                }, function (isConfirm) {
                                alert('qwe')
                                window.location.reload();

                                });
//                            $.each(data, function(key, val) {
//                                //alert(val.snum)
//                            });

                            swal("Record Updated!", "The data is successfully imported!", "success");
                        }
                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
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
                    url: 'Organization/OrganizationMembers/GetData-ajax.php',
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

        });


    </script>
    </body>

</html>
<script>
    $(document).ready(function () {
                var oTable = $('#dynamic-table').dataTable({
                        "aLengthMenu": [
                    [3, 5, 10, 15, 20, -1]
                    , [3, 5,10, 15, 20, "All"] // change per page values here
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
            , aaSorting: [[5, "desc"]]
        });
    });
    $("#TableStudSanc ").on("click ", "#StudSanctionModalClick ", function () {
        var datas = $(this).attr("value");
        $.ajax({
            url: "studSanctionModal.php?StudNo=" + datas
            , cache: false
            , async: false
            , success: function (result) {
                $(".content-sanction ").html(result);
            }
        });
    });
    $(".btnInsertSanc").on("click", function () {
        var $Code = $("#sancCode").val()
            , $Name = $("#sancName").val()
            , $Desc = $("#sancDesc").val()
            , $Time = $("#sancTime").val();


                    swal({
                            title: "Are you sure?"
                            , text: "This data will be saved and used in further transactions"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Yes, Update  it!'
                            , cancelButtonText: "No!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {


        $.ajax({
            url: "studSanctionSave.php"
            , cache: false
            , async: false
            , type: "Post"
            , data: {
                insertSanctionDetails: 'insertNow'
                , Code: $Code
                , Name: $Name
                , SDesc: $Desc
                , Time: $Time
            }
            , success: function (result) {
                alert(result);
                window.location.reload();
            }
        });
    }
                            else {
                                swal("Cancelled", "The transaction is cancelled", "error");
                            }
                        });
    });
    $(".btnInsertOff").on("click", function () {
        var $Code = $("#OffCode").val()
            , $Name = $("#OffName").val()
            , $Desc = $("#OffDesc").val()
        $.ajax({
            url: "studSanctionSave.php"
            , cache: false
            , async: false
            , type: "Post"
            , data: {
                insertDesiDetails: 'insertDesiDetails'
                , Code: $Code
                , Name: $Name
                , SDesc: $Desc
            }
            , success: function (result) {
                alert(result);
                window.location.reload();
            }
        });
    });
</script>
