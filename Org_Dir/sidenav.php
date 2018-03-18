<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li> <a <?php if( $currentPage==='Org_Dashboard' ) {echo 'class="active"';} ?> href="dashboard.php">
                        <i class ="fa fa-dashboard" ></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li> <a <?php if( $currentPage==='Org_Member' ) {echo 'class="active"';} ?> href="OrganizationMembers.php">
                        <i class="fa fa-group"></i>
                        <span>Organization Members</span>
                    </a>
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
                <h4 class="modal-title">if you are the administrator, please login.</h4>
            </div>
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
