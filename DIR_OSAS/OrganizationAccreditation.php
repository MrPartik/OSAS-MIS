<!DOCTYPE html>
<html>
<title>OSAS - Accreditaion</title>
<?php
$breadcrumbs  ="<div class='col-md-12'>
<ul class='breadcrumbs-alt'>
     <li> <a  href='#'>Organization Management</a>  </li>
<li><a class='current'' href='#'>Accreditation</a></li> </ul></div>";
$currentPage ='OSAS_OrgAccreditation';
include('header.php');
include('../config/connection.php');
?>

    <body>
        <section id="container">
            <!--header end-->
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
                    <div class="row" style="float:right;"> </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading"> Organization Management <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="space15"></div>
                                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                            <thead>
                                                <tr>
                                                    <th>Organization Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Progress</th>
                                                    <th>Accreditation Status</th>
                                                    <th style="width:1%">
                                                        <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                        $view_query = mysqli_query($con ,"SELECT DISTINCT

                OrgAccrProcess_ORG_CODE AS CODE ,OrgAppProfile_NAME AS NAME,
                (SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = OrgForCompliance_ORG_CODE AND 									OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_IS_ACCREDITED = '1')
                /
                (SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active')  * 100  PROGRESS    ,
                IF(
                    (SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active') =
                    (SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = OrgForCompliance_ORG_CODE AND 									OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_IS_ACCREDITED = '1') ,
                    'Accredited','Running for accreditation') AS STAT
                    FROM t_org_accreditation_process
                    INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgAccrProcess_ORG_CODE
					INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
            		WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active'

                                        ");
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["CODE"];
                                            $name = $row["NAME"];
                                            $stat = $row["STAT"];
                                            $prog = $row["PROGRESS"];

                                            echo "
                                            <tr class=''>
                                                <td>$code</td>
                                                <td>$name</td>
                                                <td style='width:200px'>
                                                    <div style='padding-top:10px'>
                                                        <div class='progress progress-striped progress-xs' >
                                                            <div style='width: $prog%' aria-valuemax='100' aria-valuemin='0' aria-valuenow='40' role='progressbar' class='progress-bar progress-bar-success'>
                                                                <span class='sr-only'>40% Complete (success)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$stat</td>
                                                <td style='width:200px'>
                                                    <center><a class='btn btn-cancel tar edit' style='color:white' data-toggle='modal' href='#Edit' href='javascript:;'><i class='fa fa-eye'></i></a>
                                                    </center>
                                                </td>
                                            </tr>
                                                    ";
                                        }



									?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Organization Code</th>
                                                    <th>Organization Name</th>
                                                    <th>Progress</th>
                                                    <th>Accreditation Status</th>
                                                    <th style="width:1%">
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
        </section>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
            <div class="modal-dialog" style="width:700">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Organization Accreditation</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="row" id="profile">
                                            <div class="col-lg-12 form-group"> Organization Name
                                                <select class="form-control input-sm m-bot15 selectAppCode" style="width:100%" id="drpappcode">
                                                    <option selected disabled>Choose Organization...</option>
                                                    <?php

                                                    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME FROM `t_org_for_compliance` INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE NOT IN (SELECT DISTINCT OrgAccrProcess_ORG_CODE FROM `t_org_accreditation_process` WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' )
");
                                                    while($row = mysqli_fetch_assoc($view_query))
                                                    {
                                                        $name = $row["OrgAppProfile_NAME"];
                                                        $code = $row["OrgForCompliance_ORG_CODE"];

                                                        echo "
                                                            <option value='$code'>$name</option>
                                                                ";
                                                    }



                                                ?>
                                                </select>
                                            </div>
                                            <form method="post" id="form-data4">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class='hidden'>code</th>
                                                            <th>#</th>
                                                            <th>Accreditation Name</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="accreqlist">
                                                        <?php

                                                        $view_query = mysqli_query($con,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
                                                        $i = 0;
                                                        while($row = mysqli_fetch_assoc($view_query))
                                                        {
                                                            $i++;
                                                            $desc = $row["des"];
                                                            $code = $row["code"];
                                                            echo "
                                                            <tr class=''>
                                                                <td>$i</td>
                                                                <td >$desc</td>
                                                                <td><input type='checkbox' id='chkstat$i' name='chkacc' class='checkbox form-control' style='width: 20px'></td>

                                                                <td id='code$i' class='hidden'>$code</td>
                                                            </tr>
                                                                    ";
                                                        }


                                                   ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-success " id="submit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Edit" class="modal fade">
            <div class="modal-dialog" style="width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Organization Accreditation</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <div class="row" id="profile">
                                            <div class="col-lg-12 form-group"> Organization Name
                                                <h4 id="orgname">asd</h4> </div>
                                            <form method="post" id="form-data4">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class='hidden'>code</th>
                                                            <th>#</th>
                                                            <th>Accreditation Name</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="updaccreqlist">
                                                        <?php

                                                        $view_query = mysqli_query($con,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
                                                        $i = 0;
                                                        while($row = mysqli_fetch_assoc($view_query))
                                                        {
                                                            $i++;
                                                            $desc = $row["des"];
                                                            $code = $row["code"];
                                                            echo "
                                                            <tr class=''>
                                                                <td>$i</td>
                                                                <td >$desc</td>
                                                                <td><input type='checkbox' id='chkupdstat$i' name='chkacc' class='checkbox form-control' style='width: 20px'></td>

                                                                <td id='updcode$i' class='hidden'>$code</td>
                                                            </tr>
                                                                    ";
                                                        }


                                                   ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-success " id="updsubmit-data" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <?php include('footer.php'); ?>
            <!--script for this page only-->
            <script src="Organization/OrganizationAccreditation.js"></script>
            <!-- END JAVASCRIPTS -->
            <script>
                $('#orgcode').hide();
                $(document).ready(function () {
                    var countreq = 0;
                    $('#drpappcode').change(function () {
                        //                alert('qwe');
                        var _drpappcode = document.getElementById('drpappcode');
                        var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                        var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                        $.ajax({
                            type: "GET"
                            , url: 'Organization/OrganizationAccreditation/GetData-ajax.php'
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
                    $('#submit-data').click(function () {
                        var _drpappcode = document.getElementById('drpappcode');
                        var drpname = _drpappcode.options[_drpappcode.selectedIndex].text;
                        var drpcode = _drpappcode.options[_drpappcode.selectedIndex].value;
                        var accstat = '';
                        var chkstat = '';
                        var chkcode = '';
                        var stat = 0;
                        swal({
                            title: "Are you sure?"
                            , text: "This data will be saved and used for further transaction"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#DD6B55'
                            , confirmButtonText: 'Yes!'
                            , cancelButtonText: "No!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                for (x = 1; x <= countreq; x++) {
                                    chkstat = document.getElementById('chkstat' + x);
                                    if (chkstat.checked) stat = 1;
                                    else stat = 0;
                                    reccode = document.getElementById('code' + x).innerText;
                                    $.ajax({
                                        type: 'post'
                                        , url: 'Organization/OrganizationAccreditation/AccReq-ajax.php'
                                        , data: {
                                            _drpcode: drpcode
                                            , _reccode: reccode
                                            , _stat: stat
                                        }
                                        , success: function (response) {
                                            swal("Record Updated!", "The data is successfully Added!", "success");
                                            //document.getElementById("form-data").reset();
                                        }
                                        , error: function (response) {
                                            swal("Error encountered while adding data", "Please try again", "error");
                                        }
                                    });
                                }
                            }
                            else swal("Cancelled", "The transaction is cancelled", "error");
                        });
                    });
                    $('#updsubmit-data').click(function () {
                        var compcode = document.getElementById('orgcode').innerText;
                        var accstat = '';
                        var chkstat = '';
                        var chkcode = '';
                        var stat = 0;
                        swal({
                            title: "Are you sure?"
                            , text: "This data will be saved and used for further transaction"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#DD6B55'
                            , confirmButtonText: 'Yes!'
                            , cancelButtonText: "No!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                for (x = 1; x <= <?php echo $i; ?>; x++) {
                                    chkstat = document.getElementById('chkupdstat' + x);
                                    if (chkstat.checked) stat = 1;
                                    else stat = 0;
                                    reccode = document.getElementById('updcode' + x).innerText;
                                    $.ajax({
                                        type: 'post'
                                        , url: 'Organization/OrganizationAccreditation/UpdAccReq-ajax.php'
                                        , data: {
                                            _compcode: compcode
                                            , _reccode: reccode
                                            , _stat: stat
                                        }
                                        , success: function (response) {
                                            swal("Record Updated!", "The data is successfully Added!", "success");
                                            //document.getElementById("form-data").reset();
                                        }
                                        , error: function (response) {
                                            swal("Error encountered while adding data", "Please try again", "error");
                                        }
                                    });
                                }
                            }
                            else swal("Cancelled", "The transaction is cancelled", "error");
                        });
                    });
                });
                jQuery(document).ready(function () {
                    EditableTable.init();
                });
            </script>
            <script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
            <script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
    </body>

</html>
