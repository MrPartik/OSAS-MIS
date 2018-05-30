<!DOCTYPE html>
<html>
<title>OSAS -Semester Clearance</title>
    <?php
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='#'>Clearance Management</a> </li>
    <li> <a class='current' href='studClearanceSem.php'>Semester Clearance</a> </li>
</ul>
</div>";
include('header.php');
$currentPage ='OSAS_StudClearance';
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
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon pink"><i class="fa fa-tag"></i></span>
                                <div class="mini-stat-info"> <span><?php echo mysqli_num_rows($view_studProfile)?></span> Students who cleared their clearance </div>
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
                                    <button data-toggle="modal" href="#AddDest" class="btn  btn-default"> <i class="fa fa-plus"></i> Clerance signatories</button>
                                    <div class="adv-table">
                                        <table class="display table table-bordered table-striped" id="dynamic-table" >
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Student Details</th> 
                                                    <th>Sanction</th>
                                                    <th>Conficts</th>
                                                    <th>Last Modified</th>
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php   
                                                    while($stud_row=mysqli_fetch_array($view_studProfile)) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $stud_row['Stud_NO'];?>
                                                            </td>
                                                            <td>
                                                                <?php echo '<strong>'.$stud_row['FullName'].'</strong><br>'.$stud_row['Course'];?>
                                                            </td> 
                                                            <td>
                                                                <?php  
                                                            $studNo = $stud_row['Stud_NO'];
                                                            $noRow = mysqli_fetch_array(mysqli_query($con,"SELECT `AssSancStudStudent_STUD_NO` FROM `t_assign_stud_saction` WHERE `AssSancStudStudent_STUD_NO` = '$studNo' and `AssSancStudStudent_DISPLAY_STAT` <> 'Inactive'  and `AssSancStudStudent_IS_FINISH` <>'finished'")); 
                                                            $countSanc = mysqli_num_rows(mysqli_query($con,"SELECT `AssSancStudStudent_STUD_NO` FROM `t_assign_stud_saction` WHERE `AssSancStudStudent_STUD_NO` = '$studNo' and `AssSancStudStudent_DISPLAY_STAT` <> 'Inactive'  and `AssSancStudStudent_IS_FINISH` <>'finished'"));
                                                        if($noRow){

                                                        ?>
                                                        
                                                        <center> <a id="StudSanctionModalClick" value="<?php echo $noRow[0] ; ?>" data-toggle="modal" href="#studSanction"  class="label label-danger label-mini"> <?php echo  $countSanc ?></a></center>
                                                            </td>
                                                            <?php
                                                        }else{ ?>
                                                        <center> <a class="label label-success label-mini"> <?php echo  $countSanc ?></a></center>
                                                        <?php } ?>
                                                            <td style="width:20%;"> 
                                                            <center> <strong>
                                                                <?php
                                                $clearance_view= mysqli_query($con,"SELECT B.ClearSignatories_NAME
                                                FROM  t_assign_student_clearance  A
                                                INNER JOIN  r_clearance_signatories B on A.`AssStudClearance_SIGNATORIES_CODE` = B.ClearSignatories_CODE
                                                where A.`AssStudClearance_STUD_NO` = '$studNo' 
                                                AND A.`AssStudClearance_BATCH` ='$current_acadyear'
                                                AND A.`AssStudClearance_SEMESTER`='$current_semster'
                                                AND A.`AssStudClearance_DISPLAY_STAT` ='Active'");
                                                while($row=mysqli_fetch_array($clearance_view)){ 
                                                ?>
                                                            <?php echo $row[0].',' ?>
                                                                    <?php }?>
                                                                    </strong    >
                                                                    </center>
                                                            </td>
                                                            <td> 
                                                                <?php   
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysqli_fetch_array(mysqli_query($con,"select max(`AssStudClearance_DATE_MOD`) from t_assign_student_clearance where `AssStudClearance_STUD_NO` ='$StudNo' 
                                                                       AND `AssStudClearance_BATCH` ='$current_acadyear' 
                                                                       AND `AssStudClearance_SEMESTER`='$current_semster'"));
                                                                        echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A'); 
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <button id="StudSemModalClick" value="<?php echo $stud_row['Stud_NO']; ?>" class="btn btn-info " data-toggle="modal" href="#studSemClearance"> <i class="fa  fa-info-circle"></i> </button>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Student Details</th> 
                                                    <th>Sanction</th>
                                                    <th>Confilicts</th>
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
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="AddDest" class="modal fade">
                <div class="modal-dialog" style="width:700px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Add Clearance Signatories</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now adding clearance signatories data</p>
                            <br>
                            <div class="row">
                                <div class="col-md-12 form-group"> *Signatory Code
                                    <input title="signatory code depends on the name of the signatory name" id="SigCode" type="text" class="form-control" placeholder="ex. Acco" required/> </div>
                                <div class="col-md-12 form-group"> *Signatory Name
                                    <textarea title="Signatory Name" id="SigName" type="text" class="form-control" style="resize:vertical" placeholder="ex. Accounting Office" required></textarea>
                                </div>
                                <div class="col-md-12 form-group"> *Signatory Description
                                    <textarea id="SigDesc" type="text" class="form-control" placeholder="ex. Check if the balance tuition of a specific student" style=" resize:vertical " required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button class="btnInsertSig btn btn-success " type="submit ">Submit</button>
                                <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
