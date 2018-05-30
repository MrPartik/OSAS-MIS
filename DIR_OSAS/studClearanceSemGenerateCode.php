<!DOCTYPE html>
<html>
<title>OSAS - Clearacen Semester Generate Code</title>
<?php
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='#'>Clearance Management</a> </li>
    <li> <a class='current' href='studClearanceSem.php'>Semester Clearance (Cleared Student)</a> </li>
</ul>
</div>";
include('header.php');
$currentPage ='OSAS_StudClearanceGenerateCode';
include('../config/connection.php');
$profQuery  =  mysqli_query($con,"SELECT R_SP.Stud_ID as ID ,R_SP.Stud_NO ,R_SP.Stud_LNAME,R_SP.Stud_FNAME,R_SP.Stud_MNAME,CONCAT(R_SP.Stud_LNAME,', ',R_SP.Stud_FNAME,' ',COALESCE(R_SP.Stud_MNAME,'')) as FullName ,R_SP.Stud_COURSE,CONCAT(R_SP.Stud_COURSE,' ',R_SP.Stud_YEAR_LEVEL,'-',R_SP.Stud_SECTION) as Course ,R_SP.Stud_EMAIL , R_SP.Stud_SECTION,R_SP.Stud_MOBILE_NO ,R_SP.Stud_GENDER ,R_SP.Stud_BIRTH_DATE ,R_SP.Stud_BIRTH_PLACE ,R_SP.Stud_STATUS ,R_SP.Stud_CITY_ADDRESS  FROM r_stud_profile R_SP
INNER JOIN r_stud_batch SB ON SB.Stud_NO = R_SP.Stud_NO
INNER JOIN active_academic_year AY ON Ay.ActiveAcadYear_Batch_YEAR = SB.Batch_YEAR and ay.ActiveAcadYear_IS_ACTIVE=1
WHERE R_SP.Stud_NO NOT IN (SELECT AssStudClearance_STUD_NO FROM t_assign_student_clearance WHERE  AssStudClearance_DISPLAY_STAT ='Active' AND AssStudClearance_BATCH = (SELECT ActiveAcadYear_Batch_YEAR FROM active_academic_year WHERE ActiveAcadYear_IS_ACTIVE = 1 ORDER BY ActiveAcadYear_ID DESC)
AND AssStudClearance_SEMESTER = (SELECT ActiveSemester_SEMESTRAL_NAME FROM active_semester WHERE ActiveSemester_IS_ACTIVE = 1 ORDER BY ActiveSemester_ID DESC))
AND R_SP.Stud_NO NOT IN (SELECT AssSancStudStudent_STUD_NO FROM t_assign_stud_saction WHERE AssSancStudStudent_IS_FINISH = 'Processing' AND AssSancStudStudent_DISPLAY_STAT = 'Active' )
ORDER BY ay.ActiveAcadYear_ID DESC");
?>

    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon green"><i class="fa fa-tag"></i></span>
                                <div class="mini-stat-info"> <span><?php echo mysqli_num_rows($profQuery)?></span> Students who cleared their clearance </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                                <div class="mini-stat-info"> <span> <?php echo $current_acadyear?></span> Activate Academic Year </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $current_semster?></span> Activate Semester </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">Semestral Clearance Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>  
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div id="TableStudSanc" class="panel-body">
                                    <button class="btn btn-info" id="generateSelected"> <i class="fa fa-check-square"></i> (<span id="countSelected">0</span>) Generate Selected?</button>
                                    <div class="adv-table">
                                        <table class="display table table-bordered table-striped" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Student Details</th>
                                                    <th>Generated Code</th>
                                                    <th>Date Generated</th>
                                                    <th>Date Claimed</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                    <th>
                                                        <center>
                                                            <input type="checkbox" id="selectAll" style="transform: scale(1.5);"> </center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while($stud_row = mysqli_fetch_assoc($profQuery))
                                                    {
                                                                view_clearanceGen($stud_row['Stud_NO']);
                                                                $clearance = mysqli_fetch_assoc($view_clearanceGeneratedCodeQuery);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $stud_row['Stud_NO'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo '<strong>'.$stud_row['FullName'].'</strong><br>'.$stud_row['Course'];?> </td>
                                                        <td>
                                                            <?php  echo $clearance["ClearanceGenCode_COD_VALUE"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $clearance["ClearanceGenCode_IS_GENERATE"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $clearance["ClearanceGenCode_IS_CLAIMED"]; ?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <?php if($clearance["ClearanceGenCode_COD_VALUE"]!=""){ ?>
                                                                    <button data-toggle="modal" href="#studSemClearanceQRCode" id="StudSemViewQR" value="<?php echo $clearance['ClearanceGenCode_ID']; ?>" studno="<?php echo $stud_row['Stud_NO']; ?>" genValue="<?php echo $clearance['ClearanceGenCode_COD_VALUE']; ?>" class="btn btn-info " title="View QR Code"> <i class="fa  fa-qrcode"></i> </button>
                                                                    <button data-toggle="modal" href="#studSemViewCompletion" id="StudSemViewCompletion" value="<?php echo $clearance['ClearanceGenCode_ID']; ?>" studno="<?php echo $stud_row['Stud_NO']; ?>" genValue="<?php echo $clearance['ClearanceGenCode_COD_VALUE']; ?>" class="btn btn-success " title="View Completion Form"> <i class="fa  fa-file"></i> </button> |
                                                                    <button id="StudSemUndo" value="<?php echo $clearance['ClearanceGenCode_ID']; ?>" class="btn btn-danger " title="Undo generated clearance form"> <i class="fa fa-rotate-left"></i> </button>
                                                                    <?php }else{?>
                                                                        <button id="StudSemModalGenerate" value="<?php echo $stud_row['Stud_NO']; ?>" class="btn btn-default " title="Generate Code"> <i class="fa  fa-check"></i> </button>
                                                                        <?php }?>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <?php if($clearance["ClearanceGenCode_COD_VALUE"]==""){ ?>
                                                                    <input type="checkbox" id="selectMe" style="transform: scale(1.5);" value="<?php echo $stud_row['Stud_NO']; ?>">
                                                                    <?php }else { ?>
                                                                        <input type="checkbox" disabled style="transform: scale(1.5);">
                                                                        <?php } ?>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Student Details</th>
                                                    <th>Generated Code</th>
                                                    <th>Date Generated</th>
                                                    <th>Date Claimed</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-check-square"></i></center>
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
            <div id="studSemClearanceQRCode" class="modal fade content-profile" role="dialog "> </div>
            <div id="studSemViewCompletion" class="modal fade content-Form" role="dialog "> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>
    </body>

</html>
<script>
    $("#TableStudSanc").on("click ", "#StudSemViewQR ", function () {
        var datas = $(this).attr("genValue");
        $.ajax({
            url: "studClearanceSemGenerateCodeModal.php?genData=" + datas
            , type: "POST"
            , data: {
                ViewQR: "ViewQR"
            }
            , cache: false
            , async: false
            , success: function (result) {
                $(".content-profile ").html(result);
            }
        });
    });
    $("#TableStudSanc").on("click ", "#StudSemViewCompletion ", function () {
        var studno = $(this).attr('studno');
        $.ajax({
            url: "studClearanceSemGenerateCodeModal.php?studno=" + studno
            , cache: false
            , type: "POST"
            , data: {
                ViewCompletion: "ViewCompletion"
            }
            , async: false
            , success: function (result) {
                $(".content-Form").html(result);
            }
        });
    });
    var oTable = $('#dynamic-table').dataTable({
        "aLengthMenu": [
                    [3, 5, 10, 15, 20, -1]
                    , [3, 5, 10, 15, 20, "All"] // change per page values here
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
        , aaSorting: [[3, "desc"]]
        , "aoColumnDefs": [{
                'bSortable': false
                , 'aTargets': [6]
                        }
                ]
    });
    $("button[id='StudSemModalGenerate']").on("click", function () {
        var StudNo = $(this).val();
        swal({
            title: "Finalize the clearance of this student"
            , text: "The Student: " + $(this).val() + " is subject for claiming clearance form"
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: '#9DD656'
            , confirmButtonText: 'Yes!'
            , cancelButtonText: "No!"
            , closeOnConfirm: false
            , closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'post'
                    , url: 'studClearanceSemSave.php'
                    , data: {
                        generateCode: 'generateCode'
                        , studNo: StudNo
                        , CurrSem: "<?php echo $current_semster?>"
                        , CurrAcadY: "<?php echo $current_acadyear?>"
                    }
                    , success: function (result) {
                        swal({
                            title: "Woaah, that's neat!"
                            , text: "The Code is Successfuly Generated"
                            , type: "success"
                            , showCancelButton: false
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Ok'
                        }, function (isConfirm) {
                            location.reload();
                        });
                    }
                    , error: function (result) {
                        swal("Error", "The transaction is cancelled", "error");
                    }
                });
            }
            else {
                swal("Cancelled", "The transaction is cancelled", "error");
            }
        });
    });
    $("button[id='StudSemUndo']").on("click", function () {
        var ID = $(this).val();
        swal({
            title: "Finalize the clearance of this student"
            , text: "The Student: " + $(this).val() + " is subject for claiming clearance form"
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: '#9DD656'
            , confirmButtonText: 'Yes!'
            , cancelButtonText: "No!"
            , closeOnConfirm: false
            , closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'post'
                    , url: 'studClearanceSemSave.php'
                    , data: {
                        deleteGeneratedCode: 'generateCode'
                        , ID: ID
                        , CurrSem: "<?php echo $current_semster?>"
                        , CurrAcadY: "<?php echo $current_acadyear?>"
                    }
                    , success: function (result) {
                        swal({
                            title: "Woaah, that's neat!"
                            , text: "The Code is Successfuly Generated"
                            , type: "success"
                            , showCancelButton: false
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Ok'
                        }, function (isConfirm) {
                            location.reload();
                        });
                    }
                    , error: function (result) {
                        swal("Error", "The transaction is cancelled", "error");
                    }
                });
            }
            else {
                swal("Cancelled", "The transaction is cancelled", "error");
            }
        });
    });
    $(oTable.fnGetNodes()).find("td:nth-child(7) input").on("click", function () {
        var countt = 0;
        $(oTable.fnGetNodes()).find("td:nth-child(7) input").each(function () {
            if ($(this).prop("checked")) {
                countt++;
            }
        });
        $("#countSelected").text(countt);
    });
    $("#selectAll").on("click", function () {
        var countt = 0;
        $(oTable.fnGetNodes()).find("td:nth-child(7) input").each(function (index) {
            if (!$(this).prop("checked") && !$(this).prop("disabled")) {
                $(this).prop('checked', true);
                var StudNo = $(this).val();
                countt++;
            }
            else {
                $(this).prop("checked", false);
            }
        });
        oTable.fnDraw();
        $("#countSelected").text(countt);
    });
    $("#generateSelected").on("click", function () {
        if ($("#countSelected").text() == 0) {
            swal("0 Selected", "The transaction is cancelled", "error");
        }
        else {
            swal({
                title: "Are you sure?"
                , text: $("#countSelected").text() + " students is subject for clearance completion"
                , type: "warning"
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: false
                , showLoaderOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $(oTable.fnGetNodes()).find("td:nth-child(7) input").each(function (index) {
                        if ($(this).prop("checked") && !$(this).prop("disabled")) {
                            var StudNo = $(this).val();
                            $.ajax({
                                type: 'post'
                                , url: 'studClearanceSemSave.php'
                                , data: {
                                    generateCode: 'generateCode'
                                    , studNo: StudNo
                                    , CurrSem: "<?php echo $current_semster?>"
                                    , CurrAcadY: "<?php echo $current_acadyear?>"
                                }
                                , success: function (result) {}
                                , error: function (result) {
                                    swal("Error", "The transaction is cancelled", "error");
                                }
                            });
                        }
                    }).promise().done(function (result) {
                        console.log(result);
                        setTimeout(function () {
                            swal({
                                title: "Woaah, that's neat!"
                                , text: "The Code is Successfuly Generated"
                                , type: "success"
                                , showCancelButton: false
                                , confirmButtonColor: '#9DD656'
                                , confirmButtonText: 'Ok'
                            }, function (isConfirm) {
                                location.reload();
                            })
                        }, 10000)
                    });
                }
                else {
                    swal("Cancelled", "The transaction is cancelled", "error");
                }
            });
        }
    });
</script>
