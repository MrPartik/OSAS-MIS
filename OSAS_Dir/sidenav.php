<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
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
                <li class="sub-menu">
                    <a href="javascript:;"> <i class="fa fa-users"></i> <span>Organization Management</span> </a>
                    <ul class="sub">
                        <li><a href="Admin/Organization/">Applicants</a></li>
                        <li><a href="#">Organization Profile</a></li>
                        <li><a href="#">Accreditation</a></li>
                        <li><a href="#">Financial Statement</a></li>
                        <li><a href="#">Voucher</a></li>
                        <li><a href="#">Remittance</a></li>
                    </ul>
                </li>
                <li> <a <?php if( $currentPage==='OSAS_Financial' ) {echo 'class="active"';} ?> href="finanAssign.php">
                        <i class="fa fa-money"></i>
                        <span>Financial Assistance</span>
                    </a> </li>
                <li>
                    <a <?php if( $currentPage==='OSAS_LossID' ) {echo 'class="active"';} ?> href="LossIDRegicard.php"> <i class="fa fa-asterisk"></i> <span>Loss of ID and Regi Card</span> </a>
                </li>
                <li class="sub-menu">
                    <a  <?php if( $currentPage==='OSAS_StudClearance' ) { echo 'class="active"';}?>  href="javascript:;" > <i class="fa fa-tag"></i> <span>Clearance Management</span> </a>
                    <ul class="sub">
                        <li  <?php if( $currentPage==='OSAS_StudClearance' ) { echo 'class="active"';} ?> ><a href="studClearanceSem.php" >Semestral Clearance</a></li>
                        <li><a href="#" >General Clearance</a></li>
                    </ul>
                </li>
                <li class="sub-menu" >
                    <a href="docuArchiving.php" <?php if( $currentPage==='OSAS_docuArchive' ) {echo 'class="active"';} ?> > <i class="fa fa-envelope"></i> <span>Document Archiving </span> </a>
                </li>
                <li class="sub-menu-bottom">
                    <a href="#admin-login" data-toggle="modal"> <i class="fa fa-unlock"></i> <span>Switch Administrator Account </span> </a>
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