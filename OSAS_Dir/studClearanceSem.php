<!DOCTYPE html>
<html>
<title>OSAS - Student Sanction</title>
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
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-tag"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_sanction?></span> Number of Students who has Cleared their clearance </div>
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
                                        <table class="display table table-bordered table-striped" id="dynamic-table" >
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course year and Section</th>
                                                    <th>Status</th>
                                                    <th>Progress</th>
                                                    <th>Last Modified</th>
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
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
                                                            $noRow = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT COUNT(`AssSancStudStudent_STUD_NO`) FROM `t_assign_stud_saction` WHERE `AssSancStudStudent_STUD_NO` = '$studNo' and `AssSancStudStudent_DISPLAY_STAT` <> 'Inactive'  and `AssSancStudStudent_IS_FINISH` <>'finished'), (SELECT COUNT(`AssSancStudStudent_STUD_NO`) FROM `t_assign_stud_saction` WHERE `AssSancStudStudent_STUD_NO`  = '$studNo' and `AssSancStudStudent_IS_FINISH` ='finished' and `AssSancStudStudent_DISPLAY_STAT` <> 'Inactive' )")); ?>
                                                        
                                                                    <center>
                                                                        <span class="label label-danger label-mini"> Pending </span> 
                                                                    </center>
                                                            </td>
                                                            <td style="width:20%;">
                                                                <?php
                                                viewStudSanctionComputation($stud_row['Stud_NO']);
                                                while($row=mysqli_fetch_array($view_studSanctionComputation)){ 
                                                ?>
                                                                    <div class="progress progress-striped progress-xs">
                                                                        <div style="width:0<?php echo $row['Percentage'] ?>%" aria-valuemax="100%" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success"> <span class="sr-only">40% Complete (success)</span> </div>
                                                                    </div>
                                                                    <?php }?>
                                                            </td>
                                                            <td> 
                                                                <?php   
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysqli_fetch_array(mysqli_query($con,"select max(AssSancStudStudent_DATE_MOD) from t_assign_stud_saction where AssSancStudStudent_STUD_NO ='$StudNo'"));
                                                                        echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A');
                                                                                                                          
                                                                ?>
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
                                                    <th>Course year and Section</th>
                                                    <th>Status</th>
                                                    <th>Progress</th>
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
                <div class="modal-dialog">
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
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>
                <script type="text/javascript " language="javascript " src="../js/advanced-datatable/js/jquery.dataTables.js "></script>
                <script type="text/javascript " src="../js/data-tables/DT_bootstrap.js "></script>
                <script src="../js/dynamic_table_init.js "></script>
    </body>

</html>
<script>   
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
