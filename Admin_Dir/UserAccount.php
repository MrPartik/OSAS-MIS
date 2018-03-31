<!DOCTYPE html>
<html>

<head>
    <title>OSAS - Semester</title>
    <?php    
$currentPage ='Admin_Account'; 
$breadcrumbs="
<div class='col-md-12'><ul class='breadcrumbs-alt'>
<li>
    <a  href='#'>User Management</a>
</li>
<li>
    <a class='current' href='#'>User Setup</a>
</li>  
</ul></div>";
include('header.php');  
include('../config/connection.php');
      
if($_SESSION['logged_user']['role']=="OSAS HEAD")
{ header("location:../osas_dir/dashboard.php"); }
else if($_SESSION['logged_user']['role']=="Organization")
{ } 
else if($_SESSION['logged_user']['role']=="Student")
{ }
else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
{ header("location:../");}
?>
    <link rel="stylesheet" type="text/css" href="../js/bootstrap-fileupload/bootstrap-fileupload.css" />

    <link rel="stylesheet" type="text/css" href="../js/select2/select2.css" />

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
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading"> Users Record <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                            <div class="panel-body">
                                <div class="adv-table editable-table ">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <button id="editable-sample_new" class="btn btn-success add" data-toggle="modal" href="#Add">
                                        Add <i class="fa fa-plus"></i>
                                    </button>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#">Print</a></li>
                                                <li><a href="#">Save as PDF</a></li>
                                                <li><a href="#">Export to Excel</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th style="width:20%">Role</th>
                                                <th style="width:20%">Recent Login</th>
                                                <th style="width:10%">Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
							
                                                $view_query = mysqli_query($con,"select * from `r_users`");
                                                while($row = mysqli_fetch_assoc($view_query))
                                                {
                                                    $username = $row["Users_USERNAME"];
                                                    $role = $row["Users_ROLES"];
                                                    $lastlogin = $row["Users_DATE_MOD"];										
                                                    $stat = $row["Users_DISPLAY_STAT"];										

                                                    echo "
                                                    <tr class=''>
                                                        <td>$username</td>";
                                                    if($role == 'OSAS HEAD')
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-primary'>$role</span></center></td>";
                                                    else if($role == 'Administrator')
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-success'>$role</span></center></td>";
                                                    else if($role == 'Organization')
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-inverse'>$role</span></center></td>";
                                                    else
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-warning'>$role</span></center></td>";                                        
                                                    echo "<td><center  style='padding-top:10px'><span class='label label-danger'>$lastlogin</span></center></td>";
                                                    
                                                    if($stat == 'Active')
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-success' >$stat</span></center></td>
                                                        <td style='width:180px'>
                                                            <center>
                                                                <a class='btn btn-success edit' data-toggle='modal' href='#Edit'  ><i class='fa fa-edit'></i></a>
                                                                <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-ban'></i></a>								
                                                            <center>
                                                        </td>

                                                    </tr>";
                                                    else
                                                        echo "<td ><center style='padding-top:10px'><span class='label label-danger'>$stat</span></center></td>
                                                        <td style='width:180px'>
                                                            <center>
                                                                <a class='btn btn-success edit' data-toggle='modal' href='#Edit' ><i class='fa fa-edit'></i></a>
                                                                <a class='btn btn-info retrieve' href='javascript:;'><i class='fa fa-undo'></i></a>								
                                                            <center>
                                                        </td>

                                                    </tr>";

                                                }			
											
										
									       ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Last Login</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </tfoot>
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
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="form-data" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add User Account</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-12">
                                <div class="col-lg-8">
                                    <div class="col-lg-6">
                                        User Name <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="txtusername">
                                    </div>
                                    <div class="col-lg-6">
                                        Password <input type="password" class="form-control" placeholder="ex. Password" id="txtpassword">
                                    </div>
                                    <div class="col-lg-6" style="padding-top:10px">
                                        Role
                                        <select class="form-control m-bot15" id="selRole">
                                            <option value="-1" selected disabled>Please Select an User Role</option>
                                            <option value="Administrator" >Administrator</option>
                                            <option value="OSAS HEAD" >OSAS HEAD</option>
                                            <option value="Organization" >Organization</option>
                                            <option value="Student" >Student</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="padding-top:10px" id="divref">
                                        Reference
                                        <select class="form-control m-bot15" id="selRef">
                                            <option value="-1" selected disabled>Please Select a Reference</option>
                                            <option value="Administrator" >Administrator</option>
                                            <option value="OSAS HEAD" >OSAS HEAD</option>
                                            <option value="Organization" >Organization</option>
                                            <option value="Student" >Student</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                            <img src="../images/gallery/image1.jpg" alt="" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px;min-width: 300px; min-height: 250px; line-height: 20px;"></div>
                                        <div>

                                            <span class="btn btn-white btn-file">
                                                
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip" ></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" name="file" id="file" class="default" />
                                            </span>
                                            <a href="#" class="btn btn-danger btn-sm fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="text" value="0" id="getstat" />
                        <input type="text" value="0" id="getstat2" />
                        <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
                        <button class="btn btn-success " id="submit-data" type="submit">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add User Account</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="updform-data">
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-12">
                                <div class="col-lg-8">
                                    <div class="col-lg-6">
                                        User Name <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" id="updtxtusername">
                                    </div>
                                    <div class="col-lg-6">
                                        Password <input type="password" class="form-control" placeholder="ex. Password" id="updtxtpassword">
                                    </div>
                                    <div class="col-lg-6" style="padding-top:10px">
                                        Role
                                        <select class="form-control m-bot15" id="updselRole">
                                            <option value="-1" selected disabled>Please Select an User Role</option>
                                            <option value="Administrator" >Administrator</option>
                                            <option value="OSAS HEAD" >OSAS HEAD</option>
                                            <option value="Organization" >Organization</option>
                                            <option value="Student" >Student</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="padding-top:10px" id="upddivref">
                                        Reference
                                        <select class="form-control m-bot15" id="updselRef">
                                            <option value="-1" selected disabled>Please Select a Reference</option>
                                            <option value="Administrator" >Administrator</option>
                                            <option value="OSAS HEAD" >OSAS HEAD</option>
                                            <option value="Organization" >Organization</option>
                                            <option value="Student" >Student</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                            <img src="../images/gallery/image1.jpg" alt="" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px;min-width: 300px; min-height: 250px; line-height: 20px;"></div>
                                        <div>

                                            <span class="btn btn-white btn-file">
                                                
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip" ></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" />
                                            </span>
                                            <a href="#" class="btn btn-danger btn-sm fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="updclose" type="button">Close</button>
                    <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php")?>

    <script src="SystemSetup/UserAccount.js"></script>
    <script src="../js/select2/select2.js"></script>
    <script src="../js/select-init.js"></script>
    <script type="text/javascript" src="../js/bootstrap-fileupload/bootstrap-fileupload.js"></script>

    <!-- END JAVASCRIPTS -->
    <script>
        $(document).ready(function() {});
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>

</body>

</html>
