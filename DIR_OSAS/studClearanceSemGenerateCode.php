<!DOCTYPE html>
<html>
<title>OSAS - Clearacen Semester Generate Code</title>
<?php
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='#'>Clearance Management</a> </li>
    <li> <a class='current' href='studClearanceSem.php'>Semester Clearance</a> </li>
</ul>
</div>";
include('header.php');
$currentPage ='OSAS_StudClearanceGenerateCode';
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
                        <div class="col-md-4">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-tag"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_sanction?></span> Students who cleared their clearance </div>
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
                                    <div class="adv-table">
                                        <table class="display table table-bordered table-striped" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Student Details</th>
                                                    <th>Date Claimed</th>
                                                    <th>Date Generated</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--
                                                SELECT * FROM t_clearance_generated_code
WHERE ClearanceGenCode_ACADEMIC_YEAR = (SELECT ActiveAcadYear_Batch_YEAR FROM active_academic_year WHERE ActiveAcadYear_IS_ACTIVE = 1 AND ActiveAcadYear_ID = (SELECT MAX(ActiveAcadYear_ID) FROM active_academic_year))
AND ClearanceGenCode_SEMESTER = (SELECT ActiveSemester_SEMESTRAL_NAME FROM active_semester WHERE ActiveSemester_IS_ACTIVE = 1 AND ActiveSemester_ID = (SELECT MAX(ActiveSemester_ID) FROM active_semester))
-->
                                                <? $profQuery  =  mysqli_query($con,"SELECT Stud_ID as ID ,Stud_NO ,Stud_LNAME,Stud_FNAME,Stud_MNAME,CONCAT(Stud_LNAME,', ',Stud_FNAME,' ',COALESCE(Stud_MNAME,'')) as FullName ,Stud_COURSE,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,'-',Stud_SECTION) as Course ,Stud_EMAIL , Stud_SECTION,Stud_MOBILE_NO ,Stud_GENDER ,Stud_BIRTH_DATE ,Stud_BIRTH_PLACE ,Stud_STATUS ,Stud_CITY_ADDRESS  FROM r_stud_profile R_SP
WHERE R_SP.Stud_NO NOT IN (SELECT AssStudClearance_STUD_NO FROM t_assign_student_clearance WHERE  AssStudClearance_DISPLAY_STAT ='Active' AND AssStudClearance_BATCH = (SELECT ActiveAcadYear_Batch_YEAR FROM active_academic_year WHERE ActiveAcadYear_IS_ACTIVE = 1 AND ActiveAcadYear_ID = (SELECT MAX(ActiveAcadYear_ID) FROM active_academic_year))
AND AssStudClearance_SEMESTER = (SELECT ActiveSemester_SEMESTRAL_NAME FROM active_semester WHERE ActiveSemester_IS_ACTIVE = 1 AND ActiveSemester_ID = (SELECT MAX(ActiveSemester_ID) FROM active_semester)))
AND R_SP.Stud_NO NOT IN (SELECT AssSancStudStudent_STUD_NO FROM t_assign_stud_saction WHERE AssSancStudStudent_IS_FINISH = 'Processing' AND AssSancStudStudent_DISPLAY_STAT = 'Active' )");
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
                                                            <?php  echo $clearance["ClearanceGenCode_IS_CLAIMED"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $clearance["ClearanceGenCode_IS_GENERATE"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php  echo $clearance["ClearanceGenCode_DATE_MOD"]; ?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <button id="StudSemModalClick" value="<?php echo $stud_row['Stud_NO']; ?>" class="btn btn-info " data-toggle="modal" href="#studSemClearance"> <i class="fa  fa-info-circle"></i> </button>
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
                                                    <th>Date Claimed</th>
                                                    <th>Date Generated</th>
                                                    <th>Last Modified</th>
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
            <!-- Modal Sanction-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddSanc" class="modal fade">
                <div class="modal-dialog">
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
            <!-- Modal Dest-->
            <div id="studSemClearance" class="modal fade content-sanction " role="dialog "> </div>
            <div id="studSanction" class="modal fade content-sanctionss " role="dialog "> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>
    </body>

</html>
<script>
    $("#StudSanctionModalClick ").on("click ", function () {
        var datas = $(this).attr("value");
        $.ajax({
            url: "studSanctionModal.php?StudNo=" + datas
            , cache: false
            , async: false
            , success: function (result) {
                $(".content-sanctionss ").html(result);
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
        , aaSorting: [[4, "desc"]]
    });
    $("#TableStudSanc ").on("click ", "#StudSemModalClick ", function () {
        var datas = $(this).attr("value");
        $.ajax({
            url: "studClearanceSemModal.php?StudNo=" + datas
            , cache: false
            , async: false
            , success: function (result) {
                $(".content-sanction ").html(result);
            }
        });
    });
    $(".btnInsertSig").on("click", function () {
        var $Code = $("#SigCode").val()
            , $Name = $("#SigName").val()
            , $Desc = $("#SigDesc").val()
        $.ajax({
            url: "studClearanceSemSave.php"
            , cache: false
            , async: false
            , type: "Post"
            , data: {
                insertSig: 'insertNow'
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
