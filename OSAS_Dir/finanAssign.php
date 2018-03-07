<!DOCTYPE html>
<html>
<title>OSAS - Student Profile</title>
<?php include('header.php');    
$currentPage ='OSAS_Financial';  
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
                                <li> <a class="current" href="finanAssign.php">Financial Assistance</a> </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="mini-stat clearfix"> <span class="mini-stat-icon blue"><i class="fa fa-money"></i></span>
                                <div class="mini-stat-info"> <span><?php echo $count_stud_financial_assistance; ?></span> Number of Students who has Financial Statement </div>
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
                                    <div class="adv-table" id="TableStudFinan">
                                        <table class="display table table-bordered table-striped col-md-12" id="dynamic-table">
                                            <thead>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course year and Section</th>
                                                    <th>Scholarship/s</th>
                                                    <th>Last Modified</th>
                                                    <th>
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php     
                                        if($count_stud <= 0) { ?>
                                                    <tr>
                                                        <td>Empty table</td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                    </tr>
                                                    <?php } else { while($stud_row=mysql_fetch_array($view_studProfile)) { ?>
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
                                                                <?php viewFinanStudCond(0,$stud_row['Stud_NO']);  
                                                                    $scholarship ="";
                                                        while($row = mysql_fetch_array($view_studFinanCond)){ 
                                                             
                                                                    $scholarship =  $row["Finan_Name"]." "; 
                                                                    $statusColor = ($row["Status"]==="Active")? "label-success" : "label-danger";
                                                                    $date = new DateTime($row["Start"]);
                                                                    echo "<span title ='".$date->format('D M d, Y h:i A')."' class='label ".$statusColor." label-mini'>".$scholarship."</span> &nbsp;";
                                                                    }
                                                                ?> </td>
                                                            <td>
                                                                <?php                                      
                                                                        $StudNo= $stud_row['Stud_NO'];
                                                                       $row=mysql_fetch_array(mysql_query("select max(AssStudFinanAssistance_DATE_MOD) from t_assign_stud_finan_assistance where AssStudFinanAssistance_STUD_NO ='$StudNo'"));
                                                                        echo  ($row[0]==null )?"":(new DateTime($row[0]))->format('D M d, Y h:i A');
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <button id="btnStudFinan" value="<?php echo $stud_row['Stud_NO']; ?>" data-toggle="modal" href="#studFinan" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <?php }}?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Student Number</th>
                                                    <th>Full Name</th>
                                                    <th>Course year and Section</th>
                                                    <th>Scholarship/s</th>
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
            <!-- Modal -->
            <!-- modal -->
            <!--main content end-->
            <!-- Placed js at the end of the document so the pages load faster -->
            <!--Core js-->
            <?php include('footer.php')?>  
        
            <div id="studFinan" class="modal fade content-finan" role="dialog"> </div>
    </body>
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
        $('#TableStudFinan').on("click", "#btnStudFinan", function () {
            var datas = $(this).attr("value");
            $.ajax({
                url: "finanAssignModal.php?StudNo=" + datas
                , cache: false
                , async: false
                , success: function (result) {
                    $(".content-finan").html(result);
                }
            });
        });
    </script>

</html>