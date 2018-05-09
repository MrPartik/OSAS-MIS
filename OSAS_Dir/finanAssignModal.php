<?php include ('../config/query.php'); ?>
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Details</h4> </div>
            <div class="modal-body">
                <div class='twt-feed maroon-bg'>
                    <?php viewStudProfileCond(0,$_GET['StudNo']); 
                    $data =$_GET['StudNo'];
                    while($profileLayoutRow = mysqli_fetch_array($view_studProfile_cond)){ ?>
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
                                    <h5> <?php  
                                            $statusFinan = 'INACTIVE';    
                                            viewFinanStudCond (0,$_GET['StudNo']); 
                                            while ($finanStud= mysqli_fetch_array($view_studFinanCond)){
                                            $statusFinan=  $finanStud['Status'];}
                                            echo $statusFinan;
                                            ?>
                            </h5> Scholarship Status </li>
                                <li>
                                    <h5> <?php $counter=0; $StudNo =$_GET['StudNo'];  $query= mysqli_query($con,"select 	AssStudFinanAssistance_STUD_NO  from t_assign_stud_finan_assistance where AssStudFinanAssistance_STUD_NO ='$StudNo' and AssStudFinanAssistance_DISPLAY_STAT = 'Active'" );  while(mysqli_fetch_array($query)){$counter++;} 
                                            echo $counter?>
                                            
                                            
                            </h5>Number of Scholarship/s</li>
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
                        <button id="addFinanStud" class="btnSave btn btn-default"><i class="fa fa-plus"></i> Add</button>
                        <br/>
                        <br/> </div>
                    <div class="collapse-group">
                        <div id="FinanDiv" class="row collapse panel-body">
                            <div class="col-md-6">Financial Assistance
                                <select id="finanDesc"  class="form-control m-bot15">
                                    <?php $querySanc =mysqli_query($con,"select * from r_financial_assistance_title where FinAssiTitle_DISPLAY_STAT<>'Inactive'  and `FinAssiTitle_NAME` NOT in (SELECT `AssStudFinanAssistance_FINAN_NAME` FROM t_assign_stud_finan_assistance WHERE  `AssStudFinanAssistance_DISPLAY_STAT` ='Active' AND `AssStudFinanAssistance_STUD_NO` ='$data') ORDER BY `r_financial_assistance_title`.`FinAssiTitle_CODE` "); 
                                          while($row =mysqli_fetch_array($querySanc)) { ?>
                                        <option desc="<?php echo $row['FinAssiTitle_DESC']?>" value="<?php echo $row['FinAssiTitle_NAME']?>">
                                            <?php echo $row['FinAssiTitle_NAME']?>
                                        </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">Status
                                <select id="finanStatus" class="form-control m-bot15">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                    <option>Void</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-12">Remarks
                                <textarea id="finanRemarks" style="resize:vertical; width:100%"></textarea>
                            </div>
                            <div class="col-md-6" style="width:10px">
                                <center>
                                    <br>
                                    <button id="assFinanStud" class="btnSave btn btn-primary"><i class="fa fa-plus-circle "></i> Assign</button>
                                </center>
                            </div>
                        </div>
                        <div id="TableStudSanc " class="panel-body ">
                            <div class="adv-table">
                                <table class="display table table-bordered table-striped" id="dynamic-table-modal">
                                    <thead class="cf ">
                                        <tr>
                                            <th class="hidden">Financial Assistance ID</th>
                                            <th style="width:50% ">Financial Assistance Details</th>
                                            <th class="numeric ">Status</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyFinancial">
                                        <?php 
                            viewFinanStudCond(0,$profileLayoutRow['Stud_NO']);
                            while($FinanDet=mysqli_fetch_array($view_studFinanCond)){ ?>
                                            <tr>
                                                <td class="hidden ">
                                                    <?php echo $FinanDet['ID']?>
                                                </td>
                                                <td class="TDFinanDesc"> <span class="spanSancName"><?php
                                                $dateStart =new DateTime($FinanDet['Start']);
                                                $dateMod =new DateTime($FinanDet['Mods']);
                                                echo "<strong>".$FinanDet['Finan_Name'].': '.$FinanDet['FinanDesc'].'</strong><br><br><i style="font-size:10px">Date Added: '. $dateStart->format('D M d, Y h:i A').' <br>Last Modified: '. $dateMod->format('D M d, Y h:i A').'</i>'?></span> </td>
                                                <td>
                                                    <center>
                                                        <select id="finanStatSelection" style="height: 30px;" value="<?php echo $FinanDet['Status']?>">
                                                            <option <?php if ($FinanDet[ 'Status']=='Active' ) echo 'selected' ?> >Active</option>
                                                            <option <?php if ($FinanDet[ 'Status']=='Inactive' ) echo 'selected' ?> >Inactive</option>
                                                            <option <?php if ($FinanDet[ 'Status']=='Void' ) echo 'selected' ?>>Void</option>
                                                            <option <?php if ($FinanDet[ 'Status']=='Cancelled' ) echo 'selected' ?> >Cancelled</option>
                                                        </select>
                                                    </center>
                                                </td>
                                                <td>
                                                    <textarea id="efinanRemarks" style="resize:vertical" value="<?php echo $FinanDet['remarks']?>"><?php echo $FinanDet['remarks']?> </textarea>
                                                </td>
                                                <td class="actionDes">
                                                    <center> <i style='cursor:pointer;font-size: 20px' id='deletemotoInside' class='fa fa-minus-circle'></i> </center>
                                                </td>
                                            </tr>
                                            <?php }}?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="hidden">Financial Assistance ID</th>
                                            <th style="width:50% ">Financial Assistance Details</th>
                                            <th class="numeric ">Status</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="saveFinanSet" class="btnSave btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div >
            <script>
                    var table = $('#dynamic-table-modal').DataTable({
                         bDestroy: true
                        , iDisplayLength: 3
                    });
                $('#addFinanStud').on("click", function () {
                    if ($('#FinanDiv:visible').length) {
                        $("#FinanDiv").slideToggle(500);
                        $("#addFinanStud").html("<i class='fa  fa-plus'></i>  Add");
                    }
                    else {
                        $("#FinanDiv").slideToggle(500);
                        $("#addFinanStud").html("<i class='fa  fa-arrow-circle-o-left'></i>  Back");
                    }
                });
                $("#tbodyFinancial").on("input", "textarea[id='efinanRemarks']", function () {
                    if ($(this).attr("value") == $(this).val()) $(this).closest("tr").removeClass("updatingRow");
                    else $(this).closest("tr").addClass("updatingRow");
                });
                $("#tbodyFinancial").on("change", "select[id='finanStatSelection']", function () {
                    if ($(this).attr("value") == $(this, "option:selected").val()) $(this).closest("tr").removeClass("updatingRow");
                    else $(this).closest("tr").addClass("updatingRow");
                });
                $("#assFinanStud").on("click", function () {
                    var currDate = "<?php echo dateNow(); ?>"
                        , FinanTitle = $("#finanDesc option:selected").val()
                        , FinanDesc = FinanTitle + ": " + $("#finanDesc option:selected").attr("Desc") + "<br/><br/><i style='font-size:10px'>Date Added:" + currDate + "</i>"
                        , FinanStatus = $("#finanStatus option:selected").text()
                        , FinanRemarks = $("#finanRemarks").val()
                        , opt1 = (FinanStatus == "Active") ? 'selected' : ''
                        , opt2 = (FinanStatus == "Inactive") ? 'selected' : ''
                        , opt3 = (FinanStatus == "Void") ? 'selected' : ''
                        , opt4 = (FinanStatus == "Cancelled") ? 'selected' : '';
                    $("#tbodyFinancial").find(".dataTables_empty").closest("tr ").remove();
                    $("#dynamic-table-modal > tbody:last").prepend("<tr id='newFinancialAss' ><td id='financAssDet' finanTitle='" + FinanTitle + "'><span class='label label-success'>NEW</span>" + FinanDesc + "</td><td><center><select id='finanStatSelection' style='height: 30px;' >   <option " + opt1 + " >Active</option>  <option " + opt2 + ">Inactive</option> <option " + opt3 + ">Void</option>   <option " + opt4 + " >Cancelled</option>  </select></center></td><td><textarea id='finanRemarks' style='resize:vertical'>" + FinanRemarks + "</textarea></td><td> <center> <i style='cursor:pointer;font-size: 20px' id='deletemoto' class='fa fa-minus-circle'></i> </center></td></tr>");
                });
                $("#tbodyFinancial").on("click", "i[id='deletemoto']", function (e) {
                    $(this).closest('tr').remove();
                });
                $("#tbodyFinancial").on("click", "i[id='deletemotoInside']", function (e) {
                    $(this).closest('tr').addClass("tobeRemoved");
                    $(this).closest('tr').find(".TDFinanDesc").html("<span class='label label-danger'>Delete!</span><span class='spanSancName'>  " + $(this).closest('tr').find(".spanSancName").html() + "</span>");
                    $(this).closest('tr').find(".actionDes").html(" <center> <i style='cursor:pointer;font-size: 20px' id='returnmotoInside' class='fa fa-undo'></i> </center>");
                });
                $("#tbodyFinancial").on("click", "i[id='returnmotoInside']", function (e) {
                    $(this).closest('tr').removeClass("tobeRemoved");
                    $(this).closest('tr').find(".TDFinanDesc").html("<span class='spanSancName'>" + $(this).closest('tr').find(".spanSancName").html() + "</span>");
                    $(this).closest('tr').find(".actionDes").html("  <center> <i style='cursor:pointer;font-size: 20px' id='deletemotoInside' class='fa fa-minus-circle'></i> </center>");
                });
                $("#saveFinanSet").on("click", function () {
                    var newFinancialAss = $('tbody').find("tr[id='newFinancialAss']").length
                        , tobeRemoved = $("tbody").find("tr[class='tobeRemoved']").length
                        , updatingRow = $("tbody").find("tr[class='updatingRow']").length;
                    if(newFinancialAss!=0||tobeRemoved!=0||updatingRow!=0 ){
                    if (newFinancialAss != 0) {
                        swal({
                            title: "Are you sure?"
                            , text: "This data will be added  and used for further transaction"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Yes, Add it!'
                            , cancelButtonText: "No, cancel it!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                $("tbody").find("tr[id='newFinancialAss']").each(function (i) {
                                    var $tds = $(this).find('td')
                                        , FinanTitle = $tds.eq(0).attr("finantitle")
                                        , FinanStat = $tds.eq(1).find("#finanStatSelection option:selected").val()
                                        , StudNumber = "<?php echo $_GET['StudNo']?>"
                                        , Remarks = $tds.eq(2).find("#finanRemarks").val();
                                    $.ajax({
                                        type: 'post'
                                        , url: 'finanAssignSave.php'
                                        , data: {
                                            insertFinanAss: 'FinanAssAdd'
                                            , FinanAssTitle: FinanTitle
                                            , FinanAssStat: FinanStat
                                            , StudNumber: StudNumber
                                            , FinanAssRemarks: Remarks
                                        }
                                        , success: function (result) {}
                                        , error: function (result) {
                                            swal("Error encountered while adding data", "Please try again", "error");
                                        }
                                    });
                                }).promise().done(function () {
                                    swal({
                                        title: "Woaah, that's neat!"
                                        , text: "The financial assistance or scholarship is added"
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
                            , text: "This data will be deleted permanently"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Yes, delete  it!'
                            , cancelButtonText: "No, cancel it!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                $("tbody").find("tr[class='tobeRemoved']").each(function (i) {
                                    var $tds = $(this).find('td')
                                        , ID = $tds.eq(0).text();
                                    $.ajax({
                                        type: 'post'
                                        , url: 'finanAssignSave.php'
                                        , data: {
                                            archiveFinanAss: 'archive'
                                            , ID: ID
                                        }
                                        , success: function (result) {}
                                        , error: function (result) {
                                            swal("Error encountered while deliting  data", "Please try again", "error");
                                        }
                                    });
                                }).promise().done(function () {
                                    swal({
                                        title: "Woaah, that's neat!"
                                        , text: "The financial assistance or scholarship is deleted permanently"
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
                    if (updatingRow != 0 && newFinancialAss ==0 ) {
                        swal({
                            title: "Are you sure?"
                            , text: "This data will be saved  and used in further transactions"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#9DD656'
                            , confirmButtonText: 'Yes, update it!'
                            , cancelButtonText: "No, cancel it!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                $("tbody").find("tr[class='updatingRow']").each(function (i) {
                                    var $tds = $(this).find('td')
                                        , ID = $tds.eq(0).text()
                                        , FinanStat = $tds.eq(2).find("#finanStatSelection option:selected").val()
                                        , Remarks = $tds.eq(3).find("#efinanRemarks").val();
                                    $.ajax({
                                        type: 'post'
                                        , url: 'finanAssignSave.php'
                                        , data: {
                                            updateFinanAss: 'FinanAssUpdate'
                                            , ID: ID
                                            , FinanAssStat: FinanStat
                                            , FinanAssRemarks: Remarks
                                        }
                                        , success: function (result) {}
                                        , error: function (result) {
                                            swal("Error encountered while updating  data", "Please try again", "error");
                                        }
                                    });
                                }).promise().done(function(){

                                            swal({
                                                title: "Woaah, that's neat!"
                                                , text: "The financial assistance or scholarship is now updated"
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
                    }else{
                                swal("Error", "no transaction has been made", "error");
                    }
                });
                
            $("#finanDesc").select2(); 
            </script>
