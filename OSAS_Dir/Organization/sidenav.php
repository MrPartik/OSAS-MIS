<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                
                <li class="sub-menu">
                    <a <?php if( $currentPage==='OSAS_OrgApplication' || $currentPage==='OSAS_OrgProfile' || $currentPage==='OSAS_OrgAccreditation' || $currentPage==='OSAS_OrgMembers' ) { echo 'class="active"';} ?> href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span>Organization Management</span>
                    </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='OSAS_OrgApplication' ) { echo 'class="active"';} ?> ><a href="OrganizationApplication.php">Applicants</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgProfile' ) { echo 'class="active"';} ?> ><a href="OrganizationCompliance.php">Organization Profile</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgAccreditation' ) { echo 'class="active"';} ?> ><a href="OrganizationAccreditation.php">Accreditation</a></li>
                        <li <?php if( $currentPage==='OSAS_OrgMembers' ) { echo 'class="active"';} ?>><a href="OrganizationMembers.php">Organization Members</a></li>
                        <li><a href="#">Financial Statement</a></li>
                        <li><a href="#">Voucher</a></li>
                        <li><a href="#">Remittance</a></li>
                    </ul>
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