<?php
    $user = $_SESSION['logged_user']['username'];

?>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="RemittanceApproval" class="modal fade">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <div class="col-md-12">
                <!--widget start-->
                <aside class="profile-nav alt">
                    <section class="panel" id="approvalBody">

                    </section>
                </aside>
                <!--widget end-->
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="EventApproval" class="modal fade">
    <div class="modal-dialog" style="width:50%">
        <div class="modal-content">
            <div class="col-md-12">
                <!--widget start-->
                <aside class="profile-nav alt">
                    <section class="panel" id="EventApprovalBody">
                    </section>
                </aside>
                <!--widget end-->
            </div>
        </div>
    </div>
</div>