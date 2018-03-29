<!DOCTYPE html>
<html>

<head>
    <title>Admin - Active Academic Year and Semester</title>
    <?php   
$currentPage ='Admin_ActiveYear'; 
$breadcrumbs = '                    <div class="col-md-12  ">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumbs-alt ">
                            <li>
                                <a class="current" href="#">Admin Setup</a>
                            </li>
                            <li>
                                <a href="#">Active Academic Year</a>
                            </li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
';
include('header.php');  
include('../config/connection.php');

?>
</head>

<body>

    <section id="container">
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->

                <?php
                
                    include('sidenav.php')
            
                ?>
                    <!-- sidebar menu end-->

            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                            <div class="mini-stat-info"> <span id="lblactiveyear"> <?php echo $current_acadyear;?></span> Activated Academic Year </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-stat clearfix"> <span class="mini-stat-icon tar"><i class="fa  fa-chain"></i></span>
                            <div class="mini-stat-info"> <span id="lblactivesem"><?php echo $current_semster;?></span> Activated Semester </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="adv-table editable-table ">
                                    <div class="space15"></div>
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Academic Year </th>
                                                    <th>Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form method="post">
                                                    <?php
							
										$view_query = mysqli_query($con,"select * from `r_batch_details` where Batch_DISPLAY_STAT = 'Active' ");
                                        $i = 1;
										while($row = mysqli_fetch_assoc($view_query))
										{
											$code = $row["Batch_CODE"];
											$name = $row["Batch_YEAR"];
											$desc = $row["Batch_DESC"];										
											$id = $row["Batch_ID"];								
                                            if($current_acadyear == $name) 
                                            {
                                                echo "
                                                    <tr class=''>
                                                        <td >$name</td>
                                                        <td>
                                                            <center>
                                                                <input type='radio' id='radstat$i' name='radbtn' code='$name' checked class='checkbox form-control myradio' style='width: 20px'
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    ";

                                                
                                            }
                                            else{
                                                echo "
                                                    <tr class=''>
                                                        <td >$name</td>
                                                        <td>
                                                            <center>
                                                                <input type='radio' id='radstat$i' name='radbtn' code='$name'  class='checkbox form-control myradio' style='width: 20px'
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    ";

                                                
                                                
                                            }
                                            $i = $i + 1;    
										}			
											
										
									?>


                                                </form>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="adv-table editable-table ">
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>Semestral Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
							 
								$view_query = mysqli_query($con,"select * from `r_semester` where Semestral_DISPLAY_STAT = 'Active'  ");
								while($row = mysqli_fetch_assoc($view_query))
								{
									$name = $row["Semestral_NAME"];
									$desc = $row["Semestral_DESC"];										
									
									$id = $row["Semestral_ID"];										
									if($current_semster == $name )
                                    {
                                        
                                        echo "
                                        <tr>
                                            <td>$name</td>
                                            <td>
                                                <center>
                                                    <input type='radio'  name='sem' code='$name' checked  class='checkbox form-control myradioSem' style='width: 20px'
                                                </center>
                                            </td>


                                        </tr>
                                            ";
        
                                    }
                                    else{
                                                                                echo "
                                        <tr>
                                            <td>$name</td>
                                            <td>
                                                <center>
                                                    <input type='radio'  name='sem' code='$name'   class='checkbox form-control myradioSem' style='width: 20px'
                                                </center>
                                            </td>


                                        </tr>
                                            ";

                                        
                                    }
                                    
                                }			
                                        
										
									?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </section>
        </section>
        <!--main content end-->
        <!--right sidebar start-->
        <div class="right-sidebar">
            <div class="right-stat-bar">
                <ul class="right-side-accordion">
                    <li class="widget-collapsible">
                        <ul class="widget-container">
                            <li>
                                <div class="prog-row side-mini-stat clearfix">

                                    <div class="side-mini-graph">
                                        <div class="target-sell">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--right sidebar end-->

    </section>
    <?php include("footer.php") ?>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {});
        jQuery(document).ready(function() {
            $('.myradio').on('change', function() {
                document.getElementById('lblactiveyear').innerText = $(this).attr('code');
                $.ajax({
                    type: 'post',
                    url: 'Active/Add-ajax.php',
                    data: {
                        _code: $(this).attr('code')


                    },
                    success: function(response) {
                        swal("Record Added!", "The data is successfully added!", "success");
                        e.preventDefault();
                        var aiNew = oTable.fnAddData([latcode, txtreqname, txtreqdesc, '<center><a class="btn btn-success  edit" href="">Edit</a> <a class="btn btn-danger delete" href="javascript:;">Delete</a>	</center>', ]);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        document.getElementById("form-data").reset();


                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                        $("#editable-sample_new").click();
                    }

                });


            });
            $('.myradioSem').on('change', function() {
                document.getElementById('lblactivesem').innerText = $(this).attr('code');
                $.ajax({
                    type: 'post',
                    url: 'Active/AddSem-ajax.php',
                    data: {
                        _code: $(this).attr('code')


                    },
                    success: function(response) {
                        swal("Record Added!", "The data is successfully added!", "success");
                        e.preventDefault();
                        var aiNew = oTable.fnAddData([latcode, txtreqname, txtreqdesc, '<center><a class="btn btn-success  edit" href="">Edit</a> <a class="btn btn-danger delete" href="javascript:;">Delete</a>	</center>', ]);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        document.getElementById("form-data").reset();


                    },
                    error: function(response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                        $("#editable-sample_new").click();
                    }

                });

            });
        });

    </script>

</body>

</html>
