<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a <?php if( $currentPage==='OSAS_AdminDashboard' ) {echo 'class="active"';} ?> href=" Dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='OSAS_BatchYear' || $currentPage==='OSAS_Title' || $currentPage==='OSAS_Semester' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Student Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_Title' ) { echo 'class="active"';} ?>><a href=" StudentSetup/FinancialAssistanceTitle.php">Assistance Title</a></li>
                        <li <?php if( $currentPage==='OSAS_BatchYear' ) { echo 'class="active"';} ?> ><a href=" StudentSetup/BatchYear.php">Batch Year</a></li>
                        <li <?php if( $currentPage==='OSAS_Semester' ) { echo 'class="active"';} ?>><a href=" StudentSetup/Semester.php">Semester</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='OSAS_AccreditationRequirement' || $currentPage==='OSAS_Course' || $currentPage==='OSAS_OfficerPosition' || $currentPage==='OSAS_OrganizationCategory' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Organization Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_AccreditationRequirement' ) { echo 'class="active"';} ?> ><a href=" OrganizationSetup/AccreditationRequirement.php">Accreditation Requirement</a></li>
                        <li <?php if( $currentPage==='OSAS_Course' ) { echo 'class="active"';} ?>><a href=" OrganizationSetup/Course.php">Course</a></li>
                        <li <?php if( $currentPage==='OSAS_OrganizationCategory' ) { echo 'class="active"';} ?>><a href=" OrganizationSetup/OrganizationCategory.php">Organization Category</a></li>
                        <li <?php if( $currentPage==='OSAS_OfficerPosition' ) { echo 'class="active"';} ?>><a href=" OrganizationSetup/OfficerPosition.php">Officer Position</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='OSAS_ClearanceSignatory' || $currentPage==='OSAS_DesignatedOffice' || $currentPage==='OSAS_SanctionDetail' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Sanction Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_ClearanceSignatory' ) { echo 'class="active"';} ?> ><a href=" SanctionSetup/ClearanceSignatory.php">Clearance Signatory</a></li>
                        <li <?php if( $currentPage==='OSAS_DesignatedOffice' ) { echo 'class="active"';} ?>><a href=" SanctionSetup/DesignatedOffice.php">Designated Office</a></li>
                        <li <?php if( $currentPage==='OSAS_SanctionDetail' ) { echo 'class="active"';} ?>><a href=" SanctionSetup/SanctionDetail.php">Sanction Detail</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="admin-login" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
            </div>
            <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-               default" type="button">Cancel</button>
                <button class="btn btn-success" type="button">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
