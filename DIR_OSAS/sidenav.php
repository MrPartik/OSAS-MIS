<style>
    .userpic {
        display: inline-block;
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .topNav {
        color: white;
        margin: auto;
        width: 50%;
        padding: 10px;
    }
    .topNav:hover{
        color:aqua

    }
</style>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <!--
            <center style="margin-top: 40%;"><img src="../ASSETS/images/OSAS/MAAM%20DEM.jpg" class="userpic" alt="lock avatar">
                <span class="label label-info col-lg-12 "><?php echo $user_check; ?></span></center>-->
<!--
            <div style="padding-top:100px; color:white; padding-left:20%">
                <a class="topNav" href="dashboard.php"> <i class="fa fa-dashboard"></i> </a>
                <a class="topNav" href="dashboard.php"> <i class="fa fa-dashboard"></i> </a>
                <a class="topNav" href="dashboard.php"> <i class="fa fa-dashboard"></i> </a>
            </div>
-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li> <a <?php if( $currentPage==='OSAS_Dashboard' ) {echo 'class="active"';} ?> href="dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a> </li>
                <li class="sub-menu"> <a <?php if( $currentPage==='OSAS_StudProfile' || $currentPage==='OSAS_StudSanction' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Student Management</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_StudProfile' ) { echo 'class="active"';} ?> ><a href="studprofile.php">Student Profile</a></li>
                        <li <?php if( $currentPage==='OSAS_StudSanction' ) { echo 'class="active"';} ?>><a href="studSanction.php">Student Sanction</a></li>
                    </ul>
                </li>
                <li class="sub-menu"> <a href="javascript:;" <?php if( $currentPage==='OSAS_OrgAccreditation' || $currentPage==='OSAS_OrgApplication' || $currentPage==='OSAS_OrgCompliance' || $currentPage==='OSAS_OrgPos' || $currentPage==='OSAS_OrgMem' || $currentPage==='OSAS_OrgApplicant' || $currentPage==='OSAS_Remittance' || $currentPage==='OSAS_Cflow' || $currentPage==='OSAS_OrgVouch' || $currentPage==='OSAS_Event' ) { echo 'class="active"';} ?> > <i class="fa fa-users"></i> <span>Organization Management</span> </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_Event' ) { echo 'class="active"';} ?>><a href="Event.php">Event Management</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgApplicant' ) { echo 'class="active"';} ?> ><a href="OrganizationApplicant.php">Applicant</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgApplication' ) { echo 'class="active"';} ?> ><a href="OrganizationApplication.php">Application Process</a></li>
                        <!-- <li <?php if( $currentPage==='OSAS_OrgCompliance' ) { echo 'class="active"';} ?> ><a href="OrganizationCompliance.php">Organization Profile</a></li> -->
                        <!-- <li <?php if( $currentPage==='OSAS_OrgAccreditation' ) { echo 'class="active"';} ?> ><a href="OrganizationAccreditation.php">Accreditation</a></li> -->
                        <li <?php if( $currentPage==='OSAS_OrgMem' ) { echo 'class="active"';} ?> ><a href="OrganizationMembers.php">Organization Members</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgPos' ) { echo 'class="active"';} ?> ><a href="OrganizationPosition.php">Officer Position</a></li>
                        <!--<li><a href="#">Financial Statement</a></li> --!>
                        <li <?php if( $currentPage==='OSAS_Remittance' ) { echo 'class="active"';} ?>><a href="Remittance.php">Remittance</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgVouch' ) { echo 'class="active"';} ?> ><a href="OrganizationVoucher.php">Voucher</a></li>
                        <li <?php if( $currentPage==='OSAS_Cflow' ) { echo 'class="active"';} ?>><a href="CashFlowStatement.php">Cashflow Statement</a></li>
                    </ul>
                </li>
                <li> <a <?php if( $currentPage==='OSAS_Financial' ) {echo 'class="active"';} ?> href="finanAssign.php">
                        <i class="fa fa-money"></i>
                        <span>Financial Assistance</span>
                    </a> </li>
                <li> <a <?php if( $currentPage==='OSAS_LossID' ) {echo 'class="active"';} ?> href="LossIDRegicard.php"> <i class="fa fa-asterisk"></i> <span>Loss of ID and Regi Card</span> </a> </li>
                <li class="sub-menu"> <a <?php if( $currentPage==='OSAS_StudClearance' ) { echo 'class="active"';}?>  href="javascript:;" > <i class="fa fa-tag"></i> <span>Clearance Management</span> </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_StudClearance' ) { echo 'class="active"';} ?> ><a href="studClearanceSem.php">Semestral Clearance</a></li>
                        <li><a href="#">General Clearance</a></li>
                        <li><a href="#">View Cleared Clearance</a></li>
                        <li><a href="#">View not Cleared Clearance</a></li>
                    </ul>
                </li>
                <li class="sub-menu"> <a href="docuArchiving.php" <?php if( $currentPage==='OSAS_docuArchive' ) {echo 'class="active"';} ?> > <i class="fa fa-envelope"></i> <span>Document Archiving </span> </a> </li>
                <li class="sub-menu" style="position: absolute;bottom: 0;width: 100%;"> <a href="docuArchiving.php" <?php if( $currentPage==='Config' ) {echo 'class="active"';} ?> > <i class="fa fa-gears"></i> <span>Configuration & Maintenance </span> </a>
                    <ul class="sub">
                        <!-- Please modify this -->
                        <li <?php if( $currentPage==='' ) { echo 'class="active"';} ?>><a href="#">Student Sanction</a></li>
                        <li <?php if( $currentPage==='' ) { echo 'class="active"';} ?> ><a href="#">System Configuration</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="#admin-login" data-toggle="modal"> <i class="fa fa-unlock"></i> <span>Switch Administrator Account </span> </a>
                </li> -->
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="admin-login" class="modal fade">
    <div class="modal-dialog" style="width:500px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">if you are the administrator, please login.</h4> </div>
            <div class="modal-body">
                <div class="input-group m-bot15"> <span class="input-group-addon"><i class ="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Username"> </div>
                <div class="input-group m-bot15"> <span class="input-group-addon"><i class ="fa fa-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Password"> </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-               default" type="button">Cancel</button>
                    <button class="btn btn-success" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
