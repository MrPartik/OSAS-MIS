<?php include ('../config/query.php'); ?>
    <div class="modal-dialog" style="width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Details</h4> </div>
            <div class="modal-body">
                <div class="row"> 
                  <div class="col-md-12">
                        <br/>
                        <br/>
                        <button id="addStudLoss" class="btnSave btn btn-default"><i class="fa fa-plus"></i> Add</button>
                        <button id="MoreInfo" class="btnSave btn btn-info"><i class="fa fa-info-circle"></i> More Info</button>
                        <br/>
                        <br/>
                    </div>
            </div>
                <div id="profilee">
                <div class='twt-feed maroon-bg'>
                    <?php viewStudProfileCond(0,$_GET['StudNo']); 
                    $data =$_GET['StudNo'];
                    while($profileLayoutRow = mysqli_fetch_array($view_studProfile_cond)){ ?>
                        <div class='corner-ribon black-ribon'><i class='fa fa-user'></i></div>
                        <div class='fa fa-user wtt-mark'></div><a href='#'><img alt='<?php echo $profileLayoutRow['FullName']?>' src='../ASSETS/images/Student//Student.png'></a>
                        <h1>
                    <?php echo $profileLayoutRow['FullName']?>
                </h1>
                        <p>
                            <?php echo $profileLayoutRow['Stud_EMAIL']?>
                        </p>
                        <p>
                            <?php echo $profileLayoutRow['Stud_NO']?>
                        </p>
                        <br/>
                        <br/>
                        <?php
                                                                            $ID =0;
                                                                            $Regi =0;
                                                                            $StudNo =$profileLayoutRow['Stud_NO'];
                                                                            $row = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Identification Card') as ID
,(SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Registration Card') as Regi"));
                                                                             $ID = $row["ID"];
                                                                             $Regi = $row["Regi"];
                                                                ?>
                            <div class='weather-category twt-category'>
                                <ul>
                                    <li class='active'>
                                        <h5>
                                        <?php echo $ID ?>
                                    </h5> Loss of Identification Card </li>
                                    <li>
                                        <h5>
                                        <?php echo $Regi ?>
                                    </h5>Loss of Registration Card</li>
                                    <li>
                                        <h5>
                                <?php echo $profileLayoutRow['Course']?>
                            </h5> Course </li>
                                </ul>
                            </div>
                </div></div>
                <div class="row">
                  
                    <div class="collapse-group">
                        <div id="LossDiv" class="row collapse panel-body">
                            <div class="col-md-4">ID or RegiCard
                                <select id="lossDesc" class="form-control m-bot15">
                                    <option>Registration Card</option>
                                    <option>Identification Card</option>
                                </select>
                            </div>
                            <div class="col-md-4">Remarks
                                <textarea id="lossRemarks" style="resize:vertical; width:100%; "></textarea>
                            </div>
                            <div class="col-md-4" style="width:10px">
                                <center>
                                    <br>
                                    <button id="assLossStud" class="btnSave btn btn-primary"><i class="fa fa-plus-circle "></i> Assign</button>
                                </center>
                            </div>
                        </div>
                        <div id="TableStudSanc " class="panel-body ">
                            <div class="adv-table">
                                <table class="display table table-bordered table-striped" id="dynamic-table-modal">
                                    <thead class="cf ">
                                        <tr>
                                            <th class="hidden">Loss Details ID</th>
                                            <th style="width:50% ">Loss Details</th>
                                            <th class="numeric ">Date Claimed</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyLosscial">
                                        <?php 
                            viewStud_LossCond(0,$profileLayoutRow['Stud_NO']);
                            while($LossDet=mysqli_fetch_array($view_studLossCond)){ ?>
                                            <tr>
                                                <td class="hidden ">
                                                    <?php echo $LossDet['ID']?>
                                                </td>
                                                <td class="TDLossDesc" > <span class="spanSancName"><?php
                                                $dateStart =new DateTime($LossDet['start']);
                                                $dateMod =new DateTime($LossDet['mods']);
                                                echo "<strong>".$LossDet['type'].'</strong><br><br><i style="font-size:10px">Date Added: '. $dateStart->format('D M d, Y h:i A').' <br>Last Modified: '. $dateMod->format('D M d, Y h:i A').'</i>'?></span> </td>
                                                <td>
                                                    <input id="DateClaim" type="date" class="form-control" value=<?php echo (new DateTime($LossDet[ 'claim']))->format('Y-m-d'); ?>> </td>
                                                <td>
                                                    <textarea id="lossRemarks" style="resize:vertical" value="<?php echo $LossDet['remarks']?>"><?php echo $LossDet['remarks']?></textarea>
                                                </td>
                                                <td class="actionDes">
                                                    <center> <i style='cursor:pointer;font-size: 20px' id='deletemotoInside' class='fa fa-minus-circle'></i> </center>
                                                </td>
                                            </tr>
                                            <?php }}?>
                                    </tbody>
                                    <tfoot class="cf ">
                                        <tr>
                                            <th class="hidden">Loss Details ID</th>
                                            <th style="width:50% ">Loss Details</th>
                                            <th class="numeric ">Date Claimed</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="saveLossSet" class="btnSave btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("tbody").find("tr").find("input#DateClaim").each(function () {
                    if ($(this).val().length) {
                        $(this).closest("tr").find("td.TDLossDesc").css("background", "#d6fbd6");
                    }
                });

                $("#profilee").hide();
                $("#MoreInfo").on("click", function () {
                    if (!$("#profilee:visible").length) {
                        $("#profilee").slideToggle();
                        $(this).html('<i class="fa  fa-arrow-circle-o-left"></i> Hide Info');
                    }
                    else {
                        $("#profilee").slideToggle();
                        $(this).html('<i class="fa  fa-info-circle"></i> More Info');
                    }
                });
                var oTable = $('#dynamic-table-modal').dataTable({
                    "aLengthMenu": [
                    [3, 5, 15, 20, -1]
                    , [3, 5, 15, 20, "All"] // change per page values here
                ], // set the initial value
                    "iDisplayLength": 3
                    , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                    , "sPaginationType": "bootstrap"
                    , "oLanguage": {
                        "sLengthMenu": "_MENU_ records per page"
                        , "oPaginate": {
                            "sPrevious": "Prev"
                            , "sNext": "Next"
                        }
                    }
                    , aaSorting: [[1, "desc"]]
                });
                $('#addStudLoss').on("click", function () {
                    if ($('#LossDiv:visible').length) {
                        $("#LossDiv").slideToggle(500);
                        $("#addStudLoss").html("<i class='fa  fa-plus'></i>  Add");
                    }
                    else {
                        $("#LossDiv").slideToggle(500);
                        $("#addStudLoss").html("<i class='fa  fa-arrow-circle-o-left'></i>  Back");
                    }
                });
                $("#tbodyLosscial").on("input", "textarea[id='lossRemarks']", function () {
                    if ($(this).attr("value") == $(this).val()) $(this).closest("tr").removeClass("updatingRow");
                    else $(this).closest("tr").addClass("updatingRow");
                });
                $("#tbodyLosscial").on("change", "input[id='DateClaim']", function () {
                    if ($(this).attr("value") == $(this).val()) $(this).closest("tr").removeClass("updatingRow");
                    else $(this).closest("tr").addClass("updatingRow");
                });
                $("#assLossStud").on("click", function () {
                    var currDate = "<?php echo dateNow(); ?>"
                        , Type = $("#lossDesc option:selected").text()
                        , LossDesc = Type + "<br/><br/><i style='font-size:10px'>Date Added:" + currDate + "</i>"
                        , LossRemarks = $("#lossRemarks").val();
                    $("#tbodyLosscial").find(".dataTables_empty").closest("tr ").remove();
                    $("#tbodyLosscial").prepend("<tr id='newLosscialAss' > <td class='hidden'></td><td id='losscAssDet' lossType='" + Type + "'><span class='label label-success'>NEW</span>" + LossDesc + "</td><td>        <input id='DateClaim'   type ='date' class='form-control' ></td><td><textarea id='lossRemarks' style='resize:vertical'>" + LossRemarks + "</textarea></td><td> <center> <i style='cursor:pointer;font-size: 20px' id='deletemoto' class='fa fa-minus-circle'></i> </center></td></tr>");
                });
                $("#tbodyLosscial").on("click", "i[id='deletemoto']", function (e) {
                    $(this).closest('tr').remove();
                });
                $("#tbodyLosscial").on("click", "i[id='deletemotoInside']", function (e) {
                    $(this).closest('tr').addClass("tobeRemoved");
                    $(this).closest('tr').find(".TDLossDesc").html("<span class='label label-danger'>Delete!</span><span class='spanSancName'>  " + $(this).closest('tr').find(".spanSancName").html() + "</span>");
                    $(this).closest('tr').find(".actionDes").html(" <center> <i style='cursor:pointer;font-size: 20px' id='returnmotoInside' class='fa fa-undo'></i> </center>");
                });
                $("#tbodyLosscial").on("click", "i[id='returnmotoInside']", function (e) {
                    $(this).closest('tr').removeClass("tobeRemoved");
                    $(this).closest('tr').find(".TDLossDesc").html("<span class='spanSancName'>" + $(this).closest('tr').find(".spanSancName").html() + "</span>");
                    $(this).closest('tr').find(".actionDes").html("  <center> <i style='cursor:pointer;font-size: 20px' id='deletemotoInside' class='fa fa-minus-circle'></i> </center>");
                });
                $("#saveLossSet").on("click", function () {
                    $("input[id='DateClaim']").defaultValue = null;
                    var newLosscialAss = $('tbody').find("tr[id='newLosscialAss']").length
                        , tobeRemoved = $("tbody").find("tr[class='tobeRemoved']").length
                        , updatingRow = $("tbody").find("tr[class='updatingRow']").length;
                    if (newLosscialAss != 0 || tobeRemoved != 0 || updatingRow != 0) {
                        if (newLosscialAss != 0) {
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
                                    $("tbody").find("tr[id='newLosscialAss']").each(function (i) {
                                        var $tds = $(this).find('td')
                                            , LossType = $tds.eq(1).attr("losstype")
                                            , LossClaim = $tds.eq(2).find("#DateClaim").val()
                                            , LossRemarks = $tds.eq(3).find("#lossRemarks").val()
                                            , StudNumber = "<?php echo $_GET['StudNo']?>"
                                        $.ajax({
                                            type: 'post'
                                            , url: 'LossIDRegicardSave.php'
                                            , data: {
                                                insertLossAss: 'LossAssAdd'
                                                , LossType: LossType
                                                , LossClaim: LossClaim
                                                , StudNumber: StudNumber
                                                , LossRemarks: LossRemarks
                                            }
                                            , success: function (result) {}
                                            , error: function (result) {
                                                swal("Error encountered while adding data", "Please try again", "error");
                                            }
                                        });
                                    }).promise().done(function () {
                                        swal({
                                            title: "Woaah, that's neat!"
                                            , text: "The Loss of ID or Regicard record is added"
                                            , type: "success"
                                            , showCancelButton: false
                                            , confirmButtonColor: '#9DD656'
                                            , confirmButtonText: 'Ok'
                                        }, function (isConfirm) {
                                            location.reload();
                                        });
                                    });
                                }
                                else {
                                    swal("Cancelled", "The transaction is cancelled", "error");
                                }
                            });
                        }
                        if (tobeRemoved != 0) {
                            swal({
                                title: "Are you sure?"
                                , text: "This data will be deleted"
                                , type: "warning"
                                , showCancelButton: true
                                , confirmButtonColor: '#9DD656'
                                , confirmButtonText: 'Yes, Delete  it!'
                                , cancelButtonText: "No!"
                                , closeOnConfirm: false
                                , closeOnCancel: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    $("tbody").find("tr[class='tobeRemoved']").each(function (i) {
                                        var $tds = $(this).find('td')
                                            , ID = $tds.eq(0).text();
                                        $.ajax({
                                            type: 'post'
                                            , url: 'LossIDRegicardSave.php'
                                            , data: {
                                                archiveLossAss: 'archive'
                                                , ID: ID
                                            }
                                            , success: function (result) {}
                                            , error: function (result) {
                                                swal("Error encountered while deleting data", "Please try again", "error");
                                            }
                                        });
                                    }).promise().done(function () {
                                        swal({
                                            title: "Woaah, that's neat!"
                                            , text: "The Loss of ID or Regicard record is deleted"
                                            , type: "success"
                                            , showCancelButton: false
                                            , confirmButtonColor: '#9DD656'
                                            , confirmButtonText: 'Ok'
                                        }, function (isConfirm) {
                                            location.reload();
                                        });
                                    });
                                }
                                else {
                                    swal("Cancelled", "The transaction is cancelled", "error");
                                }
                            });
                        }
                        if (updatingRow != 0 && newLosscialAss == 0) {
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
                                    $("tbody").find("tr[class='updatingRow']").each(function (i) {
                                        var $tds = $(this).find('td')
                                            , ID = $tds.eq(0).text()
                                            , LossClaim = $tds.eq(2).find("#DateClaim").val()
                                            , LossRemarks = $tds.eq(3).find("#lossRemarks").val()
                                        $.ajax({
                                            type: 'post'
                                            , url: 'LossIDRegicardSave.php'
                                            , data: {
                                                updateLossAss: 'LossAssUpdate'
                                                , ID: ID
                                                , LossClaim: LossClaim
                                                , LossRemarks: LossRemarks
                                            }
                                            , success: function (result) {}
                                            , error: function (result) {
                                                swal("Error encountered while updating data", "Please try again", "error");
                                            }
                                        });
                                    }).promise().done(function () {
                                        swal({
                                            title: "Woaah, that's neat!"
                                            , text: "The Loss of ID or Regicard record is updated"
                                            , type: "success"
                                            , showCancelButton: false
                                            , confirmButtonColor: '#9DD656'
                                            , confirmButtonText: 'Ok'
                                        }, function (isConfirm) {
                                            location.reload();
                                        });
                                    });
                                }
                                else {
                                    swal("Cancelled", "The transaction is cancelled", "error");
                                }
                            });
                        }
                    }
                    else {
                        swal("Error", "no transaction has been made", "error");
                    }
                });
            </script>
