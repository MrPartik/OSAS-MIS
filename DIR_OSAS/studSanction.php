<!DOCTYPE html>
<html>
<title>OSAS - Student Sanction</title>
<?php 
$breadcrumbs ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href=#'>Student Management</a> </li>
    <li> <a class='current' href='studSanction.php'>Student Sanction</a> </li>
</ul>
</div>"; 
$currentPage ='OSAS_StudSanction';     
include('header.php'); 
include('../config/connection.php');
?>
    <link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link href="../ASSETS/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="../ASSETS/js/iCheck/skins/minimal/red.css" rel="stylesheet">
    <link href="../ASSETS/js/iCheck/skins/minimal/green.css" rel="stylesheet">

    <link href="../ASSETS/js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="../ASSETS/js/iCheck/skins/square/green.css" rel="stylesheet">

    <link href="../ASSETS/js/iCheck/skins/flat/red.css" rel="stylesheet">
    <link href="../ASSETS/js/iCheck/skins/flat/green.css" rel="stylesheet">
    <body>
        <!--sidebar start-->
        <?php include('sidenav.php')?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon orange"><i class="fa fa-user"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_sanction?></span> Number of Students who has Sanction </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Sanction Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div id="TableStudSanc" class="panel-body">
                                     <div class="clearfix">
                                        <div class="btn-group">
                                            <button data-toggle="modal" href="#AddSanc" class="btn btn-default"> <i class="fa fa-plus"></i> Sanction</button>
                                            <button data-toggle="modal" style="margin-left:5px" href="#AddDest" class="btn  btn-default"> <i class="fa fa-plus"></i> Office Destination</button>
                                         </div>
                                         <div class="btn-group pull-right">
                                            <form id="upload_csv" method="post" enctype="multipart/form-data">
                                                <div class="controls col-md-12">
                                                    <div class="fileupload fileupload-new row" data-provides="fileupload"> <span class="btn btn-white btn-file" style="width:100px">
                                                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select a file</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="employee_file" id="file" type="file" class="default" accept=".csv" /> </span> <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        <button type="submit" class='btn btn-success' id="upload"> <i class='fa fa-upload'></i> Import </button>
                                                        <a type="button" href="../sample csvs/test(sanctions).csv" class='btn btn-info' id="download"> <i class='fa fa-download'></i> Template </a>
                                                        <a class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <br/>
                                    <br/>
                                        <div class="clearfix">
                                            <div class=" col-md-12"  style="margin-left:-30px;">
                                                <div class="col-md-2">
                                                    Course 
                                                    <select id="CourseFilter"  class="form-control">
                                                        <option value='Default'> All </option>
                                                        <?php

                                                            $view_query = mysqli_query($con,"SELECT Course_CODE FROM r_courses ");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $code = $row["Course_CODE"];
                                                                echo "<option value='$code'>$code</option>";
                                                            }

                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    Year 
                                                    <select id="YearFilter" class="form-control ">
                                                        <option value='Default'> All </option>
                                                        <?php

                                                            $view_query = mysqli_query($con,"SELECT Stud_YEAR_LEVEL FROM r_stud_profile GROUP BY Stud_YEAR_LEVEL");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $code = $row["Stud_YEAR_LEVEL"];
                                                                echo "<option value='$code'>$code</option>";
                                                            }

                                                        ?>
                                                    </select>   
                                                </div>
                                                <div class="col-md-2">
                                                    Section 
                                                    <select id="SectionFilter"  class="form-control ">
                                                        <option value='Default'> All </option>
                                                         <?php

                                                            $view_query = mysqli_query($con,"SELECT Stud_SECTION FROM r_stud_profile GROUP BY Stud_SECTION");
                                                            while($row = mysqli_fetch_assoc($view_query))
                                                            {
                                                                $code = $row["Stud_SECTION"];
                                                                echo "<option value='$code'>$code</option>";
                                                            }

                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                   By Status
                                                <div class="row">
                                                    <div class="flat-red col-sm-4">
                                                        <div class="radio ">
                                                            <input type="checkbox" checked="checked" id="NotClearedFilter" >
                                                            <label style="font-size:15px;color:#EC7063">Not Cleared </label>
                                                        </div>
                                                    </div>
                                                    <div class="flat-green col-md-2">
                                                        <div class="radio ">
                                                            <input type="checkbox" checked="checked" id="ClearedFilter">
                                                            <label style="font-size:15px;color:#1ABC9C">Cleared   </label>
                                                        </div>
                                                    </div>     
                                                    
                                                </div>
                                            </div>
                                            </div>

                                        </div>                                    
                                    </div>
                                    
                                    <div class="adv-table">
                                        <table class="display table table-bordered table-striped" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th width="15%">Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course</th>
                                                    <th style="width:10%">Status</th>
<!--                                                    <th class="hidden">Progress</th>-->
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php   while($stud_row=mysqli_fetch_array($view_studProfile)) { ?>
                                                    <tr>
                                                        <td >
                                                            <label class="hidden" ><?php echo $stud_row['Stud_NO'];?></label>
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
                                                            $noRow = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = '$studNo' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished'), (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE= b.SancDetails_CODE WHERE a.AssSancStudStudent_STUD_NO  = '$studNo' and a.AssSancStudStudent_IS_FINISH ='finished' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive' )")); ?>
                                                                <center> <span Title="Current Sanction/s" class="label label-danger label-mini"> <?php echo $noRow[0] ?>  </span> &nbsp; <span Title="Current Cleared Sanction/s"  class="label label-success label-mini"> <?php echo $noRow[1] ?>  </span> </center>
                                                        </td>
                                                        <?php
                                                viewStudSanctionComputation($stud_row['Stud_NO']);
                                                $row=mysqli_fetch_array($view_studSanctionComputation) 
                                                ?>
<!--
                                                            <td class="hidden" style="width:20%;" title="<?php echo $row['Percentage'] ?>"> <span class="hidden"><?php echo $row['Percentage'] ?></span>
                                                                <div class="progress progress-striped progress-xs">
                                                                    <div style="width:<?php echo $row['Percentage'] ?>%" aria-valuemax="100%" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success"> <span class="sr-only">40% Complete (success)</span> </div>
                                                                </div>
                                                            </td>
-->
                                                            <?php   
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysqli_fetch_array(mysqli_query($con,"select max(AssSancStudStudent_DATE_MOD) from t_assign_stud_saction where AssSancStudStudent_STUD_NO ='$StudNo'"));?>
                                                                <td data-order="<?php   echo  ($row[0]==null )?" ":($row[0]); ?>">
                                                                    <?php   echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A'); ?>
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
                                                    <th>Course</th>
                                                    <th style="width:10%">Status</th>
<!--                                                    <th class="hidden">Progress</th>-->
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
                <div class="modal-dialog" style="width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Add Sanction Details</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now adding sanction data</p>
                            <br>
                            <div class="row">
                                <div class="col-md-12 form-group"> *Sanction Code
                                    <input title="sanction code is depending on the sanction description, it is a short description for the sanction" id="sancCode" type="text" class="form-control" placeholder="ex. 2.1 3rdOffense" required/> </div>
<!--
                                <div class="col-md-6 form-group"> *Sanction Time Interval
                                    <input title="sanction time interval must in hours format" id="sancTime" type="number" class="form-control" placeholder="ex. 42" required/> </div>
-->
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
                <div class="modal-dialog" style="width: 700px;">
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
            <!--Core js-->
            <?php include('footer.php')?>
            <script src="../ASSETS/js/iCheck/jquery.icheck.js"></script>

            <script type="text/javascript" src="../ASSETS/js/ckeditor/ckeditor.js"></script>        
                
                <script>
                    $(document).ready(function () {
                        
                        $('#getappcode').hide();
                        $('#updstudnum').hide();
                        var countreq = 0;
                        var flag = 0;
                        $('#upload_csv').on("submit", function (e) {
                            e.preventDefault();
                            swal({
                                title: "Are you sure?"
                                , text: "This record will be saved  and used for further transaction"
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



                                     $.ajax({
                                        url: "Student/export_stud_sanction.php"
                                        , method: "POST"
                                        , data: new FormData($('#upload_csv')[0])
                                        , contentType: false, // The content type used when sending data to the server.
                                        cache: false, // To unable request pages to be cached
                                        processData: false, // To send DOMDocument or non processed data file it is set to false
                                        success: function (data) {
                                            if (data == 'Error1') {
                                                swal("Invalid File");
                                            }
                                            else if (data == "Error2") {
                                                swal("Cancelled", "Please Select File", "error");
                                            }
                                            else {
                                                setTimeout(function () {
                                                    swal({
                                                        title: "Woaah, that's neat!"
                                                        , text: "The record has been successfully updated!"
                                                        , type: "success"
                                                        , showCancelButton: false
                                                        , confirmButtonColor: '#9DD656'
                                                        , confirmButtonText: 'Ok'
                                                    }, function (isConfirm) {
                                                        location.reload();
                                                    })
                                                }, 1000);
                                            }
                                        }
                                        , error: function (response) {
                                            swal("Error encountered while adding data", "Please try again", "error");
                                        }
                                    });





                                }
                                else {
                                    swal("Cancelled", "The transaction is cancelled", "error");
                                }
                            });
                        });
                        $('#drpappcode').change(function () {
                            //                alert('qwe');
                            var _drpappcode = document.getElementById('drpappcode');
                            var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                            var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                            $.ajax({
                                type: "GET"
                                , url: 'Organization/OrganizationMembers/GetData-ajax.php'
                                , dataType: 'json'
                                , data: {
                                    _code: drpcode
                                }
                                , success: function (data) {
                                    //                        alert(data.count);
                                    countreq = data.countlist;
                                    document.getElementById('accreqlist').innerHTML = data.list;
                                }
                                , error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }
                            });
                        });
                    });
                </script>
    </body>

    
</html>
<script>
    $(document).ready(function () {
        function FilterStudent (){
                            var _CourseFilter = document.getElementById('CourseFilter');
                            var CourseFilterName = _CourseFilter.options[_CourseFilter.selectedIndex].text;
                            var CourseFilterValue = _CourseFilter.options[_CourseFilter.selectedIndex].value;
            
                            var _YearFilter = document.getElementById('YearFilter');
                            var YearFilterName = _YearFilter.options[_YearFilter.selectedIndex].text;
                            var YearFilterValue = _YearFilter.options[_YearFilter.selectedIndex].value;
            
                            var _SectionFilter = document.getElementById('SectionFilter');
                            var SectionFilterName = _SectionFilter.options[_SectionFilter.selectedIndex].text;
                            var SectionFilterValue = _SectionFilter.options[_SectionFilter.selectedIndex].value;            
            
                            var NotClearedFilter = document.getElementById('NotClearedFilter').checked;
                            var ClearedFilter = document.getElementById('ClearedFilter').checked;
                            var nfc = 'true';
                            var fc = 'true';
                            if(NotClearedFilter == false)
                                nfc = 'false';
                            if(ClearedFilter == false)
                                fc = 'false';
            
            


                            $.ajax({
                                type: "GET"
                                , url: 'Student/FillTableStudentSanction.php'
                                , dataType: 'json'
                                , data: {
                                    _CourseVal: CourseFilterValue,
                                    _YearVal: YearFilterValue,
                                    _NotClearedFilter: nfc,
                                    _ClearedFilter: fc,
                                    _SectionVal: SectionFilterValue

                                }
                                , success: function (data) {
                                    var table = $('#dynamic-table').DataTable();
                                    jQuery(table.fnGetNodes()).each(function () {
                                        oTable.fnDeleteRow(0);
                                    });
                                    $.each(data, function (key, val) {
                                        var aiNew = oTable.fnAddData([val.studnum +'<label class="hidden" >'+val.studnum+'</label>' ,val.name,val.course, '<center> <span Title="Current Sanction/s" class="label label-danger label-mini"> ' + val.s1 +  ' </span> &nbsp; <span Title="Current Cleared Sanction/s"  class="label label-success label-mini">'+ val.s2 +'  </span> </center>' , '' ,'<center><button id="StudSanctionModalClick" value='+val.studnum+' class="btn btn-info " data-toggle="modal" href="#studSanction"> <i class="fa  fa-info-circle"></i> </button></center>']);
                                        var nRow = oTable.fnGetNodes(aiNew[0]);
                                    });
                                }
                                , error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }
                            });  

                        }
                        $('#CourseFilter').change(function() {
                        FilterStudent();
                        });
                        $('#YearFilter').change(function() {
                            FilterStudent();
                        });
                        $('#SectionFilter').change(function() {
                            FilterStudent();
                        });
                        $('#NotClearedFilter').on('ifChecked', function(event){
                            FilterStudent();
                        });  
                        $('#NotClearedFilter').on('ifUnchecked', function(event){
                            FilterStudent();
                        });     
                        $('#ClearedFilter').on('ifChecked', function(event){
                            FilterStudent();
                        });  
                        $('#ClearedFilter').on('ifUnchecked', function(event){
                            FilterStudent();
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
    });
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
            , $Time = 0;
//            $("#sancTime").val();
        if ($Code.length) {
            if ($Name.length) {
                if ($Desc.length) {
//                    if ($Time.length) {
                        swal({
                            title: "Are you sure?"
                            , text: "This data will be saved and used in further transactions"
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
                                        swal({
                                            title: "Woaah, that's neat!"
                                            , text: "Student Sanction Details is Successfully added"
                                            , type: "success"
                                            , showCancelButton: false
                                            , confirmButtonColor: '#9DD656'
                                            , confirmButtonText: 'Ok'
                                        }, function (isConfirm) {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                            else swal("Cancelled", "The transaction is cancelled", "error");
                        });
//                    }
//                    else swal("Please try again", "Please provide a time interval", "error");
                }
                else swal("Please try again", "Please provide a sanction description", "error");
            }
            else swal("Please try again", "Please provide a sanction name", "error");
        }
        else swal("Please try again", "Please provide a sanction code", "error");
    });
    $('#btnprint').click(function () {
        var items = [];
        alert($('#CourseFilter').val())
        var Course = $('#CourseFilter').val()
        var Year = $('#YearFilter').val()
        var Section = $('#SectionFilter').val()
        var rows = $('#dynamic-table').dataTable().$('tr', {
            "filter": "applied"
        });
        $(rows).each(function (index, el) {
            items.push($(this).closest('tr').children('td:first').find('label').text());
        })
        window.open('Print/StudentSanction_Print.php?items=' + items + '&Course='+Course+'&Year='+Year+'&Section='+Section, '_blank');
    });

    $(".btnInsertOff").on("click", function () {
        var $Code = $("#OffCode").val()
            , $Name = $("#OffName").val()
            , $Desc = $("#OffDesc").val()
        if ($Code.length) {
            if ($Name.length) {
                if ($Desc.length) {
                    swal({
                        title: "Are you sure?"
                        , text: "This data will be saved and used in further transactions"
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
                                    swal({
                                        title: "Woaah, that's neat!"
                                        , text: "Student Sanction Designation Details is Successfully added"
                                        , type: "success"
                                        , showCancelButton: false
                                        , confirmButtonColor: '#9DD656'
                                        , confirmButtonText: 'Ok'
                                    }, function (isConfirm) {
                                        location.reload();
                                    });
                                }
                            });
                        }
                        else swal("Cancelled", "The transaction is cancelled", "error");
                    });
                }
                else swal("Please try again", "Please provide a office description", "error");
            }
            else swal("Please try again", "Please provide a office name", "error");
        }
        else swal("Please try again", "Please provide a office code", "error");
    });
</script>
