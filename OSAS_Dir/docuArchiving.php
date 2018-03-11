
<!DOCTYPE html>
<html>
<title>OSAS - Student Profile</title>
<?php include('header.php');    
$currentPage ='OSAS_docuArchive';  
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
                        <div class="col-md-12">
                            <ul class="breadcrumbs-alt">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a href="docuArchiving.php" class="current">Document Archiving</a> </li> 
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-envelope"></i></span>
                                <div class="mini-stat-info"> <span>1</span> Number of Documents </div>
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
                                    <button data-toggle="modal" href="#Add" class="btn btn-default"> <i class="fa fa-plus"></i> Add</button>
                                    <div class="adv-table" id="TableStudProfile">
                                        <table class="display table table-bordered table-striped col-md-12" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Control Number</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>File Name</th>
                                                    <th>Last Modified</th>
                                                    <th><center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td>
                                                            2017-doc-0001
                                                            </td>
                                                            <td>  
                                                            Policy of University/ Branches Required Activity Attendance and Registration Card
                                                            </td>
                                                            <td> 
                                                            Requiring the Activity attendance
                                                            </td>
                                                            <td> 
                                                            PolUniv.docx
                                                            </td>
                                                            <td> 
                                                                Wed Feb 28, 2018 11:30 PM
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <button id="btnStudProfile" value="" data-toggle="modal" href="#" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
                                                                </center>
                                                            </td>
                                                        </tr> 
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Control Numberr</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>File Name</th>
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
                                    while($course_row =mysql_fetch_array($view_course)){?>
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
            <div id="Profile" class="modal fade content-profile" role="dialog"> </div>
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?> 
                <script>
                    $(document).ready(function () {
                        var dataSrc = [];
                        var table = $('#dynamic-table').DataTable({
                            'initComplete': function () {
                                var api = this.api();
                                // Populate a dataset for autocomplete functionality
                                // using data from first, second and third columns
                                api.cells('tr', [0, 1, 2]).every(function () {
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
                            },
                            bDestroy:true
                            ,  aaSorting: [[ 4, "desc" ]]
                        });
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
    </body>
    
</html>