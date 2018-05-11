<?php include ('../config/query.php'); ?>

    <div class="modal-dialog" style="width:1000px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Voucher Requests</h4> </div>
            <div class="modal-body">
                 <div class="panel-body">
                            <div class="clearfix">
                                 
                            </div>
                            <div class="adv-table" id="TableStudProfile">
                                <table class="display table table-bordered table-striped col-md-12" id="dynamic-table-modal">
                                    <thead>
                                        <tr>
                                            <th>Voucher No.</th>
                                            <th>Organization Code</th>
                                            <th>Amount</th> 
                                            <th>Checked by</th>
                                            <th>Date Issue</th> 
                                            <th>
                                                <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php  while($vouch=mysqli_fetch_array($view_orgVoucher)) { ?>
                                        <tr><td>
                                                <center><?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?></center>
                                            </td>
                                        <td>
                                                <?php echo $vouch['OrgForCompliance_ORG_CODE']." - ".$vouch['OrgAppProfile_NAME'];?>
                                            </td>
                                            
                                            <td id="amo">
                                                <?php
                                                $v = $vouch['OrgVoucher_CASH_VOUCHER_NO'];
                                                $amo = mysqli_fetch_assoc(mysqli_query($con,"SELECT ifnull(SUM(OrgVouchItems_AMOUNT),'0.000') as amo FROM t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$v'"));
                                                echo "₱ ".$amo['amo'];?>
                                            </td>
                                            <td id="byyy">
                                                <?php echo $vouch['OrgVoucher_CHECKED_BY']?>
                                            </td>
                                            <td id="datee">
                                                <?php echo (new DateTime($vouch["OrgVoucher_DATE_ADD"]))->format('D M d, Y ')  ?>
                                            </td> 
                                            <td>
                                                <center>
                                                    <button id="btnStudProfile" orgcode="<?php echo $vouch['OrgForCompliance_ORG_CODE'];?>" vouch="<?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?>"data-toggle="modal" href="#Voucher" class="btn btn-success"> <i class="fa  fa-thumbs-o-up"></i> </button>
                                                    <button id="btnStudProfile" orgcode="<?php echo $vouch['OrgForCompliance_ORG_CODE'];?>" vouch="<?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?>"data-toggle="modal" href="#Voucher" class="btn btn-danger"> <i class="fa  fa-thumbs-o-down"></i> </button>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Voucher No.</th>
                                            <th>Organization Code</th>
                                            <th>Amount</th> 
                                            <th>Checked by</th>
                                            <th>Date Issue</th> 
                                            <th>
                                                <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
            </div>
               
        </div>
    </div>
<script>
        var table = $('#dynamic-table-modal').DataTable({iDisplayLength:3}); </script>