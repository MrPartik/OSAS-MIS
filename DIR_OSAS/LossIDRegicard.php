<!DOCTYPE html>
<html>
<title>OSAS - Student Profile</title>
<?php 
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a class='current' href='finanAssign.php'>Loss of ID and Regicard</a> </li>
</ul>
</div>"; 
$currentPage ='OSAS_LossID';  
include('header.php'); 
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
                        <!-- <div class="col-md-12">
                            <ul class="breadcrumbs-alt">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a class="current" href="finanAssign.php">Loss of ID and Regicard</a> </li>
                            </ul>
                        </div> -->
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-asterisk"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_LossIDRegiCard; ?></span> Number of Students who Loss their ID or Regicard/s </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <section class="panel">
                                <header class="panel-heading"> Student Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table" id="TableStudLoss">
                                        <table class="display table table-bordered table-striped col-md-12" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course</th>
                                                    <th>ID and Regicard</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                    <?php  while($stud_row=mysqli_fetch_array($view_studProfile)) { ?>
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
                                                                            $ID =0;
                                                                            $Regi =0;
                                                                            $StudNo =$stud_row['Stud_NO'];
                                                                            $row = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Identification Card') as ID
,(SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Registration Card') as Regi"));
                                                                             $ID = $row["ID"];
                                                                             $Regi = $row["Regi"];
                                                                ?>
                                                                    <center> <span title="Identification Card" class="label label-success"><?php echo $ID ?> </span> &nbsp; <span title="Registration Card" class="label label-info"><?php echo $Regi  ?></span></center>
                                                            </td>
                                                                <?php   
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysqli_fetch_array(mysqli_query($con,"select max(AssLoss_DATE_MOD) from t_assign_stud_loss_id_regicard
                                                                        where AssLoss_STUD_NO ='$StudNo' and AssLoss_DISPLAY_STAT='Active'")); ?>
                                                            <td data-order="<?php    echo  ($row[0]==null )?"":($row[0]);  ?>"> <?php    echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A');  ?> </td>
                                                            <td>
                                                                <center>
                                                                    <button id="btnStudLoss" value="<?php echo $stud_row['Stud_NO']; ?>" data-toggle="modal" href="#studLoss" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
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
                                                    <th>ID and Regicard</th>
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
            <!-- modal -->
            <div id="studLoss" class="modal fade content-loss" role="dialog"> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>  
                <script> 
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
                    $('#TableStudLoss').on("click", "#btnStudLoss", function () {
                        var datas = $(this).attr("value");
                        $.ajax({
                            url: "LossIDRegicardModal.php?StudNo=" + datas
                            , cache: false
                            , async: false
                            , success: function (result) {
                                $(".content-loss").html(result);
                            }
                        });
                    });
                </script>
    </body>

</html>
