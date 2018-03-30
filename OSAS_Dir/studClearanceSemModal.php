<?php include ('../config/query.php'); ?>
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Details</h4> </div>
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
                            <p id="studentnumber">
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
                                        <h5><?php echo $current_acadyear?></h5> Active Academic Year</li>
                                    <li>
                                        <h5>
                                <?php echo $current_semster?>
                            </h5> Active Semester </li>
                                </ul>
                            </div>
                </div>
                <?php }?>
                    <div class="row">
                        <br/>
                        <div class="col-lg-12 form-group" id="course">
                            <Strong>Choose Signatories</Strong>
                            <br> <i>This will letting the Student Services to hold clearance</i>
                            <select multiple name="e9" id="e9" style="width:100%" class="populate">
                                <?php
                                                            $view_query = mysqli_query($con,"SELECT * FROM `r_clearance_signatories` WHERE `ClearSignatories_DISPLAY_STAT` ='active'");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $name = $row["ClearSignatories_NAME"];
                                                                $code = $row["ClearSignatories_CODE"];
                                                                echo "<option value='$code' >$name</option>  ";
                                                            }
                                                        ?>
                            </select>
                            <br>
                            <br><span class="label label-danger">NOTE!</span> Every signatories above, signifies that the student dind't cleared with the specific singatories </div>
                    </div>
                    <div class="modal-footer">
                        <button id="saveClearanceSemSave" type="submit" class="btnSave btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
            </div>
        </div>
    </div>
    <script src="../js/select2/select2.js"></script>
    <script src="../js/select-init.js"></script>
    <script>
            var table = $('#dynamic-table-modal').DataTable({
                iDisplayLength: 3
            });
        $("#saveClearanceSemSave").on("click", function () {
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
                    var $studno = $("#studentnumber").text()
                        , $acady = "<?php echo $current_acadyear?>"
                        , $sem = "<?php echo $current_semster?>";
                    $.ajax({
                        type: 'POST'
                        , url: 'studClearanceSemSave.php'
                        ,async: true
                        , data: {
                            preinst: 'pre?'
                            , studno: $studno
                            , acady: $acady
                            , sem: $sem
                        }
                        , success: function (result) {}
                        , error: function (result) {
                            swal("Error encountered while adding data", "Please try again", "error");
                        }
                    });
                    $("#e9 option:selected").each(function () {
                        var $sigcode = $(this).val();
                        $.ajax({
                            type: 'POST'
                            , url: 'studClearanceSemSave.php'
                            ,async: true
                            , data: {
                                confilictInsert: 'insertttdaw?'
                                , studno: $studno
                                , acady: $acady
                                , sem: $sem
                                , sigcode: $sigcode
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
        });
        var item = [];
        $.ajax({
            type: 'POST'
            , url: 'studClearanceSemSave.php'
            , dataType: 'json'
            , async: true
            , cache: false
            , data: {
                fillSig: "okay"
                , studno: $("#studentnumber").text()
                , acady: "<?php echo $current_acadyear?>"
                , sem: "<?php echo $current_semster?>"
            }
            , success: function (data) {
                $.each(data, function (key, val) {
                    item.push(val.sigcode);
                });
                $("#e9").select2("val", item);
            }
            , error: function (response) {
                swal(response, "Please try again", "error");
            }
        });
    </script>