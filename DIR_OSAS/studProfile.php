<!DOCTYPE html>
<html>
<title>OSAS - Student Profile</title>
<?php 
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='#'>Student Management</a> </li>
    <li> <a class='current' href='studprofile.php'>Student Profile</a> </li>
</ul>
</div>";   
$currentPage ='OSAS_StudProfile';  
include('header.php'); 
include('../config/connection.php');     

?>
<link rel="stylesheet" type="text/css" href="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.css" />
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
                                <li> <a href="#">Student Management</a> </li>
                                <li> <a class="current" href="studprofile.php">Student Profile</a> </li>
                            </ul>
                        </div> -->
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-user"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud; ?></span> Number of Students </div>
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
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <button data-toggle="modal" href="#Add" class="btn btn-default"> <i class="fa fa-plus"></i> Add</button>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                    <div class="adv-table" id="TableStudProfile">
                                        <table class="display table table-striped table-hover table-bordered" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course year and Section</th>
                                                    <th>Email Address</th>
                                                    <th>Contact Number</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  while($stud_row=mysqli_fetch_array($view_studProfile)) { ?>
                                                    <tr>
                                                        <td studno="<?php echo $stud_row['Stud_NO'];?>">
                                                            <?php echo $stud_row['Stud_NO'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['FullName'];?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['Course']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['Stud_EMAIL']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stud_row['Stud_CONTACT_NO']?>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <button id="btnStudProfile" value="<?php echo $stud_row['ID']; ?>" data-toggle="modal" href="#Profile" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
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
                                                    <th>Email Address</th>
                                                    <th>Contact Number</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="btn-group">
                                            <form id="upload_csv" method="post" enctype="multipart/form-data">
                                                <div class="controls col-md-12">
                                                    <div class="fileupload fileupload-new row" data-provides="fileupload"> <span class="btn btn-white btn-file" style="width:200px">
                                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Click to Import Members</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="employee_file" id="file" type="file" class="default" accept=".csv" /> </span> <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        <button type="submit" class='btn btn-success' id="upload">Import <i class='fa fa-cloud-upload'></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Add Student</h4> </div>
                        <div class="modal-body">
                            <br>
                            <p>You are now adding student data</p>
                            <br>
                            <div class="row">
                                <div class="col-md-4 form-group"> *Student Number
                                    <input id="studno" type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" required/> </div>
                                <div class="col-md-4 form-group"> *Email Address
                                    <input id="emailadd" type="text" class="form-control" placeholder="ex. email@email.com" required/> </div>
                                <div class="col-md-4 form-group"> *Contact Number
                                    <input id="contact" type="text" class="form-control" placeholder="ex. 099999999" required/> </div>
                                <div class="col-md-4 form-group"> *First Name
                                    <input id="fname" type="text" class="form-control" placeholder="First Name" required/> </div>
                                <div class="col-md-4 form-group"> Middle Name
                                    <input id="mname" type="text" class="form-control" placeholder="Middle Name"> </div>
                                <div class="col-md-4 form-group"> *Last Name
                                    <input id="lname" type="text" class="form-control" placeholder="Last Number" required/> </div>
                                <div class="col-md-4 form-group"> *Course
                                    <select id="course" type="text" class="form-control m-bot15" required>
                                        <?php   
                                    while($course_row =mysqli_fetch_array($view_course)){?>
                                            <option value="<?php echo $course_row['Course_CODE'] ?>">
                                                <?php echo $course_row['Course_CODE'] ?>
                                            </option>
                                            <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group"> *Section
                                    <input id="section" type="number" class="form-control" placeholder="Section" required/> </div>
                                <div class="col-md-4 form-group"> *Gender
                                    <select id="gender" type="text" class="form-control m-bot15">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group"> *Birth Date
                                    <input id="bdate" type="Date" class="form-control" required/> </div>
                                <div class="col-md-4 form-group"> Birth Place
                                    <input id="bplace" type="text" class="form-control" placeholder="ex. Quezon City"> </div>
                                <div class="col-md-4 form-group"> *Student Status
                                    <select id="studStat" class="form-control" required>
                                        <option value="Regular">Regular Student</option>
                                        <option value="Irregular">Irregular Student</option>
                                        <option value="Disqualified">Disqualified Student</option>
                                        <option value="LOA">Leave of Absence</option>
                                        <option value="Transferee">Transferee Student</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group"> *Address
                                    <input id="address" type="text" class="form-control" placeholder="enter your home/ permanent address"> </div>
                            </div>
                            <div class="modal-footer">
                                <button name="insert" class="btnInsert btn btn-success" type="submit">Submit</button>
                                <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
            <div id="Profile" class="modal fade content-profile" > </div>           
            <div id="studSanction" class="modal fade content-sanctionss "> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>
                <script>
                    var oTable = $('#dynamic-table').dataTable({
                        "aLengthMenu": [
                    [5, 10,15, 20, -1]
                    , [5, 10,15, 20, "All"] // change per page values here
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
                        , aaSorting: [[1, "asc"]]
                    });
                    $(document).ready(function () {
                        $('#btnprint').click(function () {
                            var items = [];
                            var rows = $('#dynamic-table').dataTable().$('tr', {
                                "filter": "applied"
                            });
                            $(rows).each(function (index, el) {
                                items.push($(this).closest('tr').children('td:first').attr("studno"));
                            })
                            window.open('Print/StudentProfile_Print.php?items=' + items, '_blank');
                        });
                    });
                    $(".btnInsert").on("click", function () {
                        var $studno = $('#studno').val();
                        var $emailadd = $('#emailadd').val();
                        var $contact = $('#contact').val();
                        var $fname = $('#fname').val();
                        var $mname = $('#mname').val();
                        var $lname = $('#lname').val();
                        var $course = $('#course').val();
                        var $section = $('#section').val();
                        var $gender = $('#gender').val();
                        var $bdate = $('#bdate').val();
                        var $bplace = $('#bplace').val();
                        var $status = $('#studStat').val();
                        var $address = $('#address').val();
                        if ($studno.length && $emailadd.length && $contact.length && $fname.length && $lname.length && $bdate.length && $section.length && $address.length) {
                            $.ajax({
                                type: 'POST'
                                , url: 'studProfileSave.php'
                                , data: {
                                    action: 'insertActive'
                                    , studno: $studno
                                    , emailadd: $emailadd
                                    , contact: $contact
                                    , fname: $fname
                                    , mname: $mname
                                    , lname: $lname
                                    , course: $course
                                    , section: $section
                                    , gender: $gender
                                    , bdate: $bdate
                                    , bplace: $bplace
                                    , status: $status
                                    , address: $address
                                }
                                , success: function (result) {
                                    alert(result);
                                    window.location.reload();
                                }
                                , error: function (result) {
                                    alert('Error')
                                }
                            });
                        }
                        else alert('(*) Please provide value in reqired fields');
                    });
                    $("#TableStudProfile").on("click", "#btnStudProfile", function () {
                        var datas = $(this).attr("value");
                        $.ajax({
                            url: "studProfileModal.php?StudID=" + datas
                            , cache: false
                            , async: false
                            , success: function (result) {
                                $(".content-profile").html(result);
                            }
                        });
                    });
                </script>
    <!-- END JAVASCRIPTS -->
    <script type="text/javascript" src="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script>
        $(document).ready(function() {
            $('#getappcode').hide();
            $('#updstudnum').hide();
            var countreq = 0;
            var flag = 0;
            $('#upload_csv').on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "Organization/OrganizationMembers/Export_stud.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    success: function(data) {
                        if (data == 'Error1') {
                            swal("Invalid File");
                        } else if (data == "Error2") {
                            swal("Cancelled", "Please Select File", "error");
                        } else {
                                swal({
                                    title: "Data Imported!",
                                    text: "The csv file is successfully imported!",
                                    type: "success",
                                    confirmButtonColor: '#88A755',
                                    confirmButtonText: 'Okay',
                                    closeOnConfirm: false
                                }, function (isConfirm) {
                                alert('qwe')
                                window.location.reload();

                                });
//                            $.each(data, function(key, val) {
//                                //alert(val.snum)
//                            });

                            swal("Record Updated!", "The data is successfully imported!", "success");
                        }
                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                })

            });
            $('#drpappcode').change(function() {
                //                alert('qwe');
                var _drpappcode = document.getElementById('drpappcode');
                var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _code: drpcode
                    },
                    success: function(data) {
                        //                        alert(data.count);
                        countreq = data.countlist;
                        document.getElementById('accreqlist').innerHTML = data.list;
                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });

        });


    </script>
    </body>

</html>
