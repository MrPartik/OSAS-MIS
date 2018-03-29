<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a <?php if( $currentPage==='Admin_Dashboard' ) {echo 'class="active"';} ?> href="Dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='Admin_BYear' || $currentPage==='Admin_Title' || $currentPage==='Admin_Semester' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Student Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='Admin_Title' ) { echo 'class="active"';} ?>><a href="FinancialAssistanceTitle.php">Assistance Title</a></li>
                        <li <?php if( $currentPage==='Admin_BYear' ) { echo 'class="active"';} ?> ><a href="BatchYear.php">Batch Year</a></li>
                        <li <?php if( $currentPage==='Admin_Semester' ) { echo 'class="active"';} ?>><a href="Semester.php">Semester</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='Admin_AccrReq' || $currentPage==='Admin_Course' || $currentPage==='Admin_OfficerPos' || $currentPage==='Admin_OrgCat' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Organization Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='Admin_AccrReq' ) { echo 'class="active"';} ?> ><a href="AccreditationRequirement.php">Accreditation Requirement</a></li>
                        <li <?php if( $currentPage==='Admin_Course' ) { echo 'class="active"';} ?>><a href="Course.php">Course</a></li>
                        <li <?php if( $currentPage==='Admin_OrgCat' ) { echo 'class="active"';} ?>><a href="OrganizationCategory.php">Organization Category</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='Admin_ClearanceSig' || $currentPage==='Admin_Designated' || $currentPage==='Admin_SancDet' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Sanction Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='Admin_ClearanceSig' ) { echo 'class="active"';} ?> ><a href="ClearanceSignatory.php">Clearance Signatory</a></li>
                        <li <?php if( $currentPage==='Admin_Designated' ) { echo 'class="active"';} ?>><a href="DesignatedOffice.php">Designated Office</a></li>
                        <li <?php if( $currentPage==='Admin_SancDet' ) { echo 'class="active"';} ?>><a href="SanctionDetail.php">Sanction Detail</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='Admin_ActiveYear' || $currentPage==='Admin_ActiveSem' || $currentPage==='Admin_Account' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Admin Setup</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='Admin_ActiveYear' ) { echo 'class="active"';} ?> ><a href="ActiveAcademicYear.php">Active Academic Year and Semester</a></li>
                        <li <?php if( $currentPage==='Admin_Account' ) { echo 'class="active"';} ?>><a href="UserAccount.php">User Account</a></li>
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
