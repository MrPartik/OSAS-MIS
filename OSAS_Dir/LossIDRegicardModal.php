<?php include ('../config/query.php'); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Details</h4> </div>
            <div class="modal-body">
                <div class='twt-feed maroon-bg'>
                    <?php viewStudProfileCond(0,$_GET['StudNo']); 
                    $data =$_GET['StudNo'];
                    while($profileLayoutRow = mysql_fetch_array($view_studProfile_cond)){ ?>
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
                                                            <?php
                                                                            $ID =0;
                                                                            $Regi =0;
                                                                            $StudNo =$profileLayoutRow['Stud_NO'];
                                                                            $row = mysql_fetch_array(mysql_query("SELECT (SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Identification Card') as ID
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <br/>
                        <button id="addStudLoss" class="btnSave btn btn-default"><i class="fa fa-plus"></i> Add</button>
                        <br/>
                        <br/> </div>
                    <div class="collapse-group">
                        <div id="LossDiv" class="row collapse panel-body">
                            <div class="col-md-4" >ID or RegiCard
                                <select id="lossDesc" class="form-control m-bot15">
                                    <option>Registration Card</option>
                                    <option>Identification Card</option>
                                </select>
                            </div>  
                            <div class="col-md-4" >Remarks
                                <textarea id="lossRemarks" style="resize:vertical; width:100%"></textarea>
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
                                    <tbody id="tbodyLosscial" >
                                        <?php 
                            viewStud_LossCond(0,$profileLayoutRow['Stud_NO']);
                            while($LossDet=mysql_fetch_array($view_studLossCond)){ ?>
                                            <tr>
                                                <td class="hidden "><?php echo $LossDet['ID']?></td>
                                                <td class="TDLossDesc">
                                                    <span class="spanSancName"><?php  
                                                $dateStart =new DateTime($LossDet['start']);
                                                $dateMod =new DateTime($LossDet['mods']);
                                                echo $LossDet['type'].'<br><br><i style="font-size:10px">Date Added: '. $dateStart->format('D M d, Y h:i A').' <br>Last Modified: '. $dateMod->format('D M d, Y h:i A').'</i>'?></span> </td>
                                                <td> 
                                                        <input id="DateClaim"   type ="date" class="form-control" value=<?php  echo (new DateTime($LossDet['claim']))->format('Y-m-d'); ?>> 
                                                </td>
                                                <td>
                                                    <textarea id="lossRemarks"style="resize:vertical" value="<?php echo $LossDet['remarks']?>"><?php echo $LossDet['remarks']?></textarea>
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
        
                <script src="../js/advanced-datatable/js/autocomplete.js"></script>
        <script> 
            
            $(document).ready(function () {
                var dataSrc = [];
                var table = $('#dynamic-table-modal').DataTable({
                    'initComplete': function () {
                        var api = this.api();
                        // Populate a dataset for autocomplete functionality
                        // using data from first, second and third columns
                        api.cells('tr', [1]).every(function () {
                            // Get cell data as plain text
                            var data = $('<div>').html(this.data()).text();
                            if (dataSrc.indexOf(data) === -1) {
                                dataSrc.push(data);
                            }
                        });
                        // Sort dataset alphabetically
                        dataSrc.sort();
                        // Initialize Typeahead plug-in
                        $('.dataTables_filter input[type="search"]', api.table().container()).typeahead({
                            source: dataSrc
                            , afterSelect: function (value) {
                                api.search(value).draw();
                            }
                        });
                    }
                    , bDestroy: true
                    , aaSorting: [[1, "desc"]]
                });
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
            $("#tbodyLosscial").on("input","textarea[id='lossRemarks']",function(){
                if($(this).attr("value") == $(this).val())
                        $(this).closest("tr").removeClass("updatingRow");
                else
                     $(this).closest("tr").addClass("updatingRow");
            });
            
            $("#tbodyLosscial").on("change","input[id='DateClaim']",function(){ 
                if($(this).attr("value")==$(this).val())
                    $(this).closest("tr").removeClass("updatingRow");
                else
                    $(this).closest("tr").addClass("updatingRow");
            });
            $("#assLossStud").on("click",function(){
                var currDate ="<?php echo dateNow(); ?>"
                ,Type = $("#lossDesc option:selected").text()
                ,LossDesc =Type + "<br/><br/><i style='font-size:10px'>Date Added:"+currDate+"</i>" 
                ,LossRemarks=$("#lossRemarks").val(); 
                $("#tbodyLosscial").append("<tr id='newLosscialAss' > <td class='hidden'></td><td id='losscAssDet' lossType='"+Type+"'><span class='label label-success'>NEW</span><br> "+LossDesc+"</td><td>        <input id='DateClaim'   type ='datetime-local' class='form-control' ></td><td><textarea id='lossRemarks' style='resize:vertical'>"+LossRemarks+"</textarea></td><td> <center> <i style='cursor:pointer;font-size: 20px' id='deletemoto' class='fa fa-minus-circle'></i> </center></td></tr>");
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
                            ,LossRemarks:LossRemarks  
                        }
                        , success: function (result) {
                            alert(LossType+LossClaim+StudNumber+LossRemarks ); 
                            alert(result);
                            window.location.reload();
                        }
                        , error: function (result) {
                            alert('Error')
                        }
                    });
                });
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
                        , success: function (result) {
                            alert('');
                            alert(result);
                            window.location.reload();
                        }
                        , error: function (result) {
                            alert('Error')
                        }
                    });
                });
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
                            ,LossRemarks:LossRemarks 
                        }
                        , success: function (result) {
                            alert(ID+LossClaim+LossRemarks);
                            alert(result);
                            window.location.reload();
                        }
                        , error: function (result) {
                            alert('Error')
                        }
                    });
                });
            });
        </script>
        