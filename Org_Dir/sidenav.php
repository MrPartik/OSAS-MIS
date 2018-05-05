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
                <li> <a <?php if( $currentPage==='Org_OrgMem' ) {echo 'class="active"';} ?> href="OrganizationMembers.php">
                        <i class="fa fa-group"></i>
                        <span>Officers and Members</span>
                    </a>
                </li>
<<<<<<< HEAD
                <li> <a <?php if( $currentPage==='Org_RemReq' ) {echo 'class="active"';} ?> href="RemittanceRequest.php">
                        <i class="fa fa-tag"></i>
                        <span>Remittance</span>
                    </a>
                </li>                          
=======
                <li> <a <?php if( $currentPage==='Org_OrgOff' ) {echo 'class="active"';} ?> href="OrganizationOfficer.php">
                        <i class="fa fa-group"></i>
                        <span>Organization Officers</span>
                    </a>
                </li>
                <li> <a <?php if( $currentPage==='Org_OrgMems' ) {echo 'class="active"';} ?> href="OrganizationMember.php">
                        <i class="fa fa-group"></i>
                        <span>Organization Members</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a <?php if( $currentPage==='Org_RemReq' || $currentPage==='Org_Remit' ) { echo 'class="active"';}?>  href="javascript:;" > <i class="fa fa-tag"></i> <span>Remittance</span> </a>
                    <ul class="sub">
                        <li <?php if( $currentPage==='Org_RemReq' ) {echo 'class="active"';} ?>><a href="RemittanceRequest.php">Remittance Request</a></li>
                        <li <?php if( $currentPage==='Org_Remit' ) {echo 'class="active"';} ?>><a  href="Remittance.php">Remittance History</a></li>
                    </ul>
                </li>                
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
                <li> <a <?php if( $currentPage==='Org_Cflow' ) {echo 'class="active"';} ?> href="CashFlowStatement.php">
                        <i class="fa fa-group"></i>
                        <span>Cashflow statement</span>
                    </a>
                </li>
                <li> <a <?php if( $currentPage==='Org_Event' ) {echo 'class="active"';} ?> href="Event.php">
                        <i class="fa fa-group"></i>
                        <span>Event</span>
                    </a>
                </li>            </ul>
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
