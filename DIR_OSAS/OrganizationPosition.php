<!DOCTYPE html>
<html>
<title>OSAS - Officer Position</title>
<?php 
$breadcrumbs="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a class='current' href='OfficerPosition.php'>Officer Position</a></li>
</ul>
</div>"; 
$currentPage ='OSAS_OrgPos';  
include('header.php'); 
include('../config/connection.php');
?>

<body>
    <?php include('sidenav.php')?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading"> Officer Position <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                        <div class="panel-body">
                            <div class="adv-table editable-table ">
                                <div class="clearfix">
                                    <div class="btn-group" id="btnoffadd">
                                        <button id="editable-sample_new" data-toggle="modal" id="openAddmodal" class="btn btn-success"> Add <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                                <div class="space15" style="padding-top:15px"></div>
                                <div class="btn-group">
                                    <select class="form-control m-bot15" id="selOrg">
                                            <option selected disabled>Please Select an Organization</option>
                                            <?php


//                                                    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,OrgForCompliance_ADVISER,OrgAppProfile_STATUS,OC.OrgCat_NAME FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE INNER JOIN t_assign_org_category AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE INNER JOIN r_org_category OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active'");
                                                    
    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,OrgForCompliance_ADVISER,OrgAppProfile_STATUS
	FROM `r_org_applicant_profile` AS OAP 
    INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE 
    WHERE OFC.OrgForCompliance_DISPAY_STAT = 'Active' AND OAP.OrgAppProfile_DISPLAY_STAT = 'Active'");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $code = $row["OrgForCompliance_ORG_CODE"];
                                                        $name = $row["OrgAppProfile_NAME"];
                                                        echo '<option value="'.$code.'">' .$code.'-  '.$name.'</option>';
                                                    }


                                                ?>
                                        </select>
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th>Officer Position</th>
                                            <th>Description</th>
                                            <th style="width:10%"> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Officer Position</th>
                                            <th>Description</th>
                                            <th style="width:10%"> <center><i style="font-size:20px" class="fa fa-bolt"></i></center></th>
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
                                    <div class="target-sell"> </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--right sidebar end-->
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Officer Position</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-data">
                        <div class="row" style="padding-left:15px;padding-top:10px">
                            <div class="col-lg-6"> Officer Position
                                <input type="text" class="form-control" placeholder="ex. President" id="txtcode"> </div>
                            <div class="col-lg-6"> Occurence
                                <input type="number" class="form-control" placeholder="1" id="txtocc"> </div>
                            <div class="col-lg-8 " style="padding-top:10px"> Description
                                <textarea class="form-control" placeholder="ex. Leader of the Organization" rows="6" style="margin: 0px 202.5px 0px 0px;resize:none" id="txtdesc"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" id="close" type="button">Close</button>
                    <button class="btn btn-success " id="submit-data" type="button">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script src="../ASSETS/js/jquery-1.8.3.min.js"></script>
    <script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
    <script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../ASSETS/js/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="../ASSETS/js/sweetalert/sweetalert.min.js"></script>
    <!--common script init for all pages-->
    <script src="../ASSETS/js/scripts.js"></script>
    <!--script for this page only-->
    <script src="Organization/OrganizationPosition.js"></script>
    <!-- END JAVASCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            EditableTable.init();
        });

    </script>
</body>

</html>
