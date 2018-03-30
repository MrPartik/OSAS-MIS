<?php include ('../config/query.php'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Student Details</h4>
        </div>
        <div class="modal-body">
            <div class='twt-feed maroon-bg'>
                <?php viewStudProfileCond( 0,$_GET['StudNo']) ?>
                <?php while($profileLayoutRow = mysqli_fetch_array($view_studProfile_cond)){ ?>
                <div class='corner-ribon black-ribon'><i class='fa fa-user'></i></div>
                <div class='fa fa-user wtt-mark'></div><a href='#'><img alt='<?php echo $profileLayoutRow['FullName']?>' src='../images/Student//Student.png'></a>
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
                <div class='weather-category twt-category'>
                    <ul>
                        <li class='active'>
                            <h5>
                                <?php  
                                        $counterSanction=0; 
                                        viewStudSanctionCond($profileLayoutRow['Stud_NO']);
                                        while(mysqli_fetch_array($view_studSanctionCond)){
                                            $counterSanction++;
                                        }
                                        echo $counterSanction;  
                                 ?>
                            </h5> Sanction /s </li>
                        <li>
                            <?php $percentageSanction = "0 %";
                            viewStudSanctionComputation($profileLayoutRow['Stud_NO']);
                            while($row=mysqli_fetch_array($view_studSanctionComputation)){ 
                            
                            $percentageSanction = $row['Percentage']." %";
                            }?>
                            <h5>
                                <?php echo $percentageSanction; ?>
                            </h5>Percentage Finished</li>
                        <li>
                            <h5>
                                <?php echo $profileLayoutRow['Course']?>
                            </h5> Course </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br/>
                    <br/>
                    <button id="assignSanction" class="btnSave btn btn-default"><i class="fa fa-plus"></i> Add</button>
                    <br/>
                    <br/> </div>
                <div class="collapse-group">
                    <div id="sanctionDiv" class="row collapse panel-body">
                        <div class="col-md-4" style="width:300px"> Available Sanction
                            <select id="sanctionSelection" class="js-example-basic-single form-control m-bot15">
                                    <?php $querySanc =mysqli_query($con,"select * from r_sanction_details where SancDetails_DISPLAY_STAT = 'Active'"); 
                                          while($row =mysqli_fetch_array($querySanc)) { ?>
                                        <option sanctionCode="<?php echo $row['SancDetails_CODE'];?>" sanctionTimeValue="<?php echo $row['SancDetails_TIMEVAL']?>">
                                            <?php echo $row['SancDetails_NAME']?>
                                        </option>
                                        <?php } ?>
                                </select>
                        </div>
                        <div class="col-md-4" style="width:270px"> Available Designated Office
                            <select id="officesSelection" class="form-control m-bot15">
                                    <?php $queryDesignatedOffice =mysqli_query($con,"select * from r_designated_offices_details where DesOffDetails_DISPLAY_STAT = 'active'"); 
                                          while($desRow =mysqli_fetch_array($queryDesignatedOffice)) { ?>
                                        <option value="<?php echo  $desRow['DesOffDetails_CODE']?>">
                                            <?php echo  $desRow['DesOffDetails_NAME']?>
                                        </option>
                                        <?php }?>
                                </select>
                        </div>
                        <div class="col-md-4" style="width:10px">
                            <center>
                                <br>
                                <button id="addSanction" class="btnSave btn btn-primary"><i class="fa fa-plus-circle "></i> Assign</button>
                            </center>
                        </div>
                    </div>
                    <div id="TableStudSanc " class="panel-body ">
                        <div class="adv-table">
                            <table class="display table table-bordered table-striped" id="dynamic-table-modal">
                                <thead>
                                    <tr>
                                        <th class="hidden">Sanction ID </th>
                                        <th style="width:80% ">Sanction Details</th>
                                        <th style="width:100%">Remarks</th>
                                        <th class="numeric ">Consumed</th>
                                        <th class="numeric ">Remaining</th>
                                        <th>Finish</th>
                                        <th>To be Finished</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodySanctions">
                                    <?php 
                            view_studSanctionDetails($profileLayoutRow['Stud_NO']);
                            while($SancDetrow=mysqli_fetch_array($view_studSanctionDetails)){ ?>
                                    <tr>
                                        <td class="hidden">
                                            <?php echo $SancDetrow['AssSancID']?>
                                        </td>
                                        <td class="TDSancName"> <strong><span class="spanSancName"><?php
                                                $dateStart =new DateTime($SancDetrow['Start']);
                                                $dateMod =new DateTime($SancDetrow['Mods']);
                                                echo $SancDetrow['SanctionName'].'<br>Time Value:  '. $SancDetrow['TimeVal'].' Hours<br>Designated Office: '.$SancDetrow['Office'].'<i style="font-size:10px"><br><br></strong>Date Started: '. $dateStart->format('D M d, Y h:i A').' <br>Last Modified: '. $dateMod->format('D M d, Y h:i A').'</i>'?></span>
                                        </td>
                                        <td>
                                            <textarea id="sancRemarks" style="resize:vertical; width:100%;height:100px" value="<?php echo $SancDetrow['Remarks']?>"><?php echo $SancDetrow['Remarks']?></textarea>
                                        </td>
                                        <td class="numeric ">
                                            <center>
                                                <input id="inputConsume" sancID="<?php echo $SancDetrow['AssSancID']?>" style="width:50px; text-align:center;" maxVal="<?php echo $SancDetrow[ 'TimeVal']?>" value="<?php echo $SancDetrow['Consumed']?>" required/> </center>
                                        </td>
                                        <td class="timeRemaining numeric ">
                                            <?php echo $SancDetrow['TimeVal']-$SancDetrow['Consumed']?>
                                        </td>
                                        <td>
                                            <center>
                                                <input id="checkFinished" checkStatus="<?php echo  $SancDetrow[ 'FINISHED'] ?>" <?php if( $SancDetrow[ 'FINISHED']==='Finished' ) {echo 'checked';} ?> type="checkbox" /></center>
                                        </td>
                                         <td> <center><input id="tobeDone" class="form-control" type="Date" >
                                            </center>  </td>
                                        <td class="actionDes">
                                            <center><i title="Delete" style='cursor:pointer;font-size: 20px; ' id='deletemotoInside' class='fa fa-minus-circle  '></i> </center> 

                                        </td>
                                        <div id="sanctionDivs" class="row collapse panel-body">
                                            <div class="col-md-4" style="width:300px"> Available Sanction
                                                <select id="sanctionSelection" class="js-example-basic-single form-control m-bot15">
                                    <?php $querySanc =mysqli_query($con,"select * from r_sanction_details where SancDetails_DISPLAY_STAT = 'Active'");
                                          while($row =mysqli_fetch_array($querySanc)) { ?>
                                        <option sanctionCode="<?php echo $row['SancDetails_CODE'];?>" sanctionTimeValue="<?php echo $row['SancDetails_TIMEVAL']?>">
                                            <?php echo $row['SancDetails_NAME']?>
                                        </option>
                                        <?php } ?>
                                </select>
                                            </div>
                                            <div class="col-md-4" style="width:270px"> Available Designated Office
                                                <select id="officesSelection" class="form-control m-bot15">
                                    <?php $queryDesignatedOffice =mysqli_query($con,"select * from r_designated_offices_details where DesOffDetails_DISPLAY_STAT = 'active'");
                                          while($desRow =mysqli_fetch_array($queryDesignatedOffice)) { ?>
                                        <option value="<?php echo  $desRow['DesOffDetails_CODE']?>">
                                            <?php echo  $desRow['DesOffDetails_NAME']?>
                                        </option>
                                        <?php }?>
                                </select>
                                            </div>
                                            <div class="col-md-4" style="width:10px">
                                                <center>
                                                    <br>
                                                    <button id="addSanction" class="btnSave btn btn-primary"><i class="fa fa-plus-circle "></i> Assign</button>
                                                </center>
                                            </div>
                                        </div>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="hidden">Sanction ID </th>
                                        <th style="width:80% ">Sanction Details</th>
                                        <th style="width:100%">Remarks</th>
                                        <th class="numeric ">Consumed</th>
                                        <th class="numeric ">Remaining</th>
                                        <th>Finish</th>
                                        <th>To be Finished</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="saveSanctionSet" type="submit" class="btnSave btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var dataSrc = [];
            var table = $('#dynamic-table-modal').DataTable({
                'initComplete': function() {
                    var api = this.api();
                    api.cells('tr', [1]).every(function() {
                        var data = $('<div>').html(this.data()).text();
                        if (dataSrc.indexOf(data) === -1) {
                            dataSrc.push(data);
                        }
                    });
                    dataSrc.sort();
                    $('.dataTables_filter input[type="search"]', api.table().container()).typeahead({
                        source: dataSrc,
                        afterSelect: function(value) {
                            api.search(value).draw();
                        }
                    });
                },
                bDestroy: true,
                iDisplayLength: 3
            });
        });
 
        $('#assignSanction').on("click", function() {
            if ($('#sanctionDiv:visible').length) {
                $("#sanctionDiv").slideToggle(500);
                $("#assignSanction").html("<i class='fa  fa-plus'></i>  Add");
            } else {
                $("#sanctionDiv").slideToggle(500);
                $("#assignSanction").html("<i class='fa  fa-arrow-circle-o-left'></i>  Back");
            }

        });
        $("#tbodySanctions").on('input', "textarea[id='sancRemarks']", function() {
            if ($(this).val() == $(this).attr("value")) {
                $(this).closest("tr").removeClass("updatingRow");
            } else {
                $(this).closest("tr").addClass("updatingRow");
            }
        });
        $("#tbodySanctions").on('change', "input[id='checkFinished']", function() {
            var checkStatus = $(this).closest('tr').find('#checkFinished').attr('checkStatus'),
                isChecked = $(this).is(':checked') ? 'Finished' : 'Processing';
            if (checkStatus == isChecked) {
                $(this).closest('tr').removeClass('updatingRow');
            } else {
                $(this).closest('tr').addClass('updatingRow');
            }
            if ($(this).is(':checked')) {
                $(this).closest("tr").find("#inputConsume").val($(this).closest("tr").find("#inputConsume").attr("maxval"));
                $(this).closest('tr').find('.timeRemaining').html($(this).closest("tr").find("#inputConsume").attr("maxval") - $(this).closest("tr").find("#inputConsume").val());
            } else {
                $(this).closest("tr").find("#inputConsume").val($(this).closest("tr").find("#inputConsume").attr("value"));
                $(this).closest('tr').find('.timeRemaining').html($(this).closest("tr").find("#inputConsume").attr("maxval") - $(this).closest("tr").find("#inputConsume").val());
            }
        });
        $("#addSanction").on("click", function() {
            var SanctionCode = $('#sanctionSelection option:selected').attr("sanctionCode"),
                SanctionName = $('#sanctionSelection option:selected').text(),
                Hrs = $('#sanctionSelection option:selected').attr("sanctionTimeValue"),
                DesignatedOfficeCode = $('#officesSelection option:selected').attr("value"),
                DesignatedOfficeName = $('#officesSelection option:selected').text(),
                currDate = "<?php echo dateNow(); ?>",
                Remaining = $('#sanctionSelection option:selected').attr("sanctionTimeValue");

            $("#tbodySanctions").find(".dataTables_empty").closest("tr ").remove();
            $("#tbodySanctions").prepend("<tr id='newSanction'> <td class='hidden'>" + SanctionCode + "</td><td class='hidden'>" + DesignatedOfficeCode + "</td><td><span class='label label-success'>NEW</span><strong> " + SanctionName + '<br></strong>Time Value:  ' + Hrs + ' Hours' + "<br/><br/><i style='font-size:10px'>Date Added:" + currDate + "</i></td><td><textarea id='sancRemarks' style='resize:vertical; width:100%;height:100px'></textarea></td><td class='numeric'>  <center><input id='inputConsume' type='text' value='0' maxVal='" + Hrs + "' style='width:50px; text-align:center;' /> </center></td><td class='timeRemaining numeric'>" + Remaining + "</td><td> <center> <input id='checkFinished' type='checkbox'  /></center><td> <center><input id='tobeDone' class='form-control' type='Date' > </center></td></td> <td><center> <i title='Delete' style='cursor:pointer;font-size: 20px; ' id='deletemoto' class='fa fa-minus-circle '></i> </center></td>< /tr>  ");
        });
        $("#tbodySanctions").on("click", "i[id='deletemoto']", function(e) {
            $(this).closest('tr').remove();
        });
        $("#tbodySanctions").on("click", "i[id='deletemotoInside']", function(e) {
            $(this).closest('tr').addClass("tobeRemoved");
            $(this).closest('tr').find(".TDSancName").html("<span class='label label-danger'>Deactivate!</span><span class='spanSancName'>  " + $(this).closest('tr').find(".TDSancName").html() + "</span>");
            $(this).closest('tr').find(".actionDes").html(" <center> <i style='cursor:pointer;font-size: 20px' id='returnmotoInside' class='fa fa-undo'></i> </center>");
        });
        $("#tbodySanctions").on("click", "i[id='returnmotoInside']", function(e) {
            $(this).closest('tr').removeClass("tobeRemoved");
            $(this).closest('tr').find(".TDSancName").html("<span class='spanSancName'>" + $(this).closest('tr').find(".spanSancName").html() + "</span>");
            $(this).closest('tr').find(".actionDes").html("  <center> <i style='cursor:pointer;font-size: 20px' id='deletemotoInside' class='fa fa-minus-circle'></i> </center>");
        });
        $("#tbodySanctions").on('input change', "input[id='inputConsume']", function() {
            $(this).closest('tr').find('.timeRemaining').html($(this).attr('maxVal') - $(this).val());
            if ($(this).attr('value') == $(this).val()) {
                $(this).closest('tr').removeClass('updatingRow');
            } else {
                $(this).closest('tr').addClass('updatingRow');
            }
            if (parseInt($(this).attr("maxVal"), 10) < parseInt($(this).val(), 10)) {
                $(this).val($(this).attr("maxVal"));
                $(this).closest('tr').find('.timeRemaining').html($(this).attr('maxVal') - $(this).val());
            } else if (0 > parseInt($(this).val(), 10) || $(this).closest("tr").find(".timeRemaining").text() == "") {
                $(this).val(0);
            }
            if ($(this).attr("maxVal") == $(this).val()) {
                $(this).closest('tr').find("#checkFinished").prop("checked", true);
            } else {
                $(this).closest('tr').find("#checkFinished").prop("checked", false);
            }
        });
        $("#saveSanctionSet").on("click", function() {
            var newLosscialAss = $('tbody').find("tr[id='newSanction']").length,
                tobeRemoved = $("tbody").find("tr[class='tobeRemoved']").length,
                updatingRow = $("tbody").find("tr[class='updatingRow']").length;
            if (newLosscialAss != 0 || tobeRemoved != 0 || updatingRow != 0) {
                if (newLosscialAss != 0) {
                    swal({
                        title: "Are you sure?",
                        text: "This data will be added  and used for further transaction",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#9DD656',
                        confirmButtonText: 'Yes, Add it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $("#saveSanctionSet").attr("disabled", "disabled");
                            $("tbody").find("tr[id='newSanction']").each(function(i) {
                                var $tds = $(this).find('td'),
                                    SanctionCode = $tds.eq(0).text(),
                                    DesignatedOfficeCode = $tds.eq(1).text(),
                                    StudNumber = "<?php echo $_GET['StudNo']?>",
                                    Cons = $tds.eq(4).find("input[id='inputConsume']").val(),
                                    Finish = $tds.eq(6).find("input[id='checkFinished']").is(':checked') ? 'Finished' : 'Processing', 
                                    Done = $tds.eq(6).find("input[id='tobeDone']").val(),
                                    sancRemarks = $tds.eq(3).find("textarea[id='sancRemarks']").val();
                                    alert(Done);
                                $.ajax({
                                    type: 'post',
                                    url: 'studSanctionSave.php',
                                    data: {
                                        insertSanction: 'sanctionAdd',
                                        SanctionCode: SanctionCode,
                                        DesignatedOfficeCode: DesignatedOfficeCode,
                                        StudNumber: StudNumber,
                                        SancRemarks: sancRemarks,
                                        Cons: Cons,
                                        Finish: Finish
                                    },
                                    success: function(result) {

                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        alert('Error')
                                    }
                                });
                            }).promise().done(function() {
                                swal({
                                    title: "Woaah, that's neat!",
                                    text: "The Saction Detail record is added",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: '#9DD656',
                                    confirmButtonText: 'Ok'
                                }, function(isConfirm) {
                                    location.reload();
                                });
                            });
                        } else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                        }
                    });
                }
                if (tobeRemoved != 0) {
                    swal({
                        title: "Are you sure?",
                        text: "This data will be deleted",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#9DD656',
                        confirmButtonText: 'Yes, Delete  it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $("tbody").find("tr[class='tobeRemoved']").each(function(i) {
                                var $tds = $(this).find('td'),
                                    ID = $tds.eq(0).text();
                                $.ajax({
                                    type: 'post',
                                    url: 'studSanctionSave.php',
                                    data: {
                                        archiveSanction: 'sanctionAdd',
                                        ID: ID
                                    },
                                    success: function(result) {

                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        alert('Error')
                                    }
                                });
                            }).promise().done(function() {
                                swal({
                                    title: "Woaah, that's neat!",
                                    text: "The Sanction Detail record is deleted",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: '#9DD656',
                                    confirmButtonText: 'Ok'
                                }, function(isConfirm) {
                                    location.reload();
                                });
                            });
                        } else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                        }
                    });
                }
                if (updatingRow != 0 && newLosscialAss == 0) {
                    swal({
                        title: "Are you sure?",
                        text: "This data will be saved and used in further transactions",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#9DD656',
                        confirmButtonText: 'Yes, Update  it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $("tbody").find("tr[class='updatingRow']").each(function(i) {

                                var $tds = $(this).find('td'),
                                    ID = $tds.eq(0).text(),
                                    UpdateConsumed = $tds.eq(3).find("input[id='inputConsume']").val(),
                                    UpdateMax = $tds.eq(3).find("input[id='inputConsume']").attr('maxVal'),
                                    Remaining = $tds.eq(4).html(),
                                    Finish = $tds.eq(5).find("input[id='checkFinished']").is(':checked') ? 'Finished' : 'Processing',
                                    sancRemarks = $tds.eq(2).find("textarea[id='sancRemarks']").val();
                                $.ajax({
                                    type: 'post',
                                    url: 'studSanctionSave.php',
                                    data: {
                                        updateSanction: 'sanctionUpdate',
                                        ID: ID,
                                        Cons: UpdateConsumed,
                                        max: UpdateMax,
                                        finish: Finish,
                                        SancRemarks: sancRemarks
                                    },
                                    success: function(result) {

                                        window.location.reload();
                                    },
                                    error: function(result) {
                                        alert('Error')
                                    }
                                });
                            }).promise().done(function() {
                                swal({
                                    title: "Woaah, that's neat!",
                                    text: "The Sanction Detail record is updated",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: '#9DD656',
                                    confirmButtonText: 'Ok'
                                }, function(isConfirm) {
                                    location.reload();
                                });
                            });
                        } else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                        }
                    });
                }
            } else {
                swal("Error", "no transaction has been made", "error");
            }
        });

    </script>
