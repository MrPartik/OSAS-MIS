<?php include ('../config/query.php'); ?>

    <div class="modal-dialog" style="width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Voucher Details</h4> </div>
            <div class="modal-body">
                   
                <?php $orgcode = $_GET['orgcode'];?>
                <?php $vouch = $_GET['vouch'];?>
                <?php $amo = $_GET['amo'];?>
                <?php $byyy = $_GET['byyy'];?>
                <?php $datee = $_GET['datee'];?>
                <div style = "float:left;">
                <br>
        </div>
        
                    <table id="meta">
                        <tr>
                            <td class="meta-head">Voucher Number:</td>
                            <td><?php echo $vouch?></td>
                        </tr>
                        <tr> 
                        <td class="meta-head">Date Issued</td>
                        <td><p id="cash"><?php echo $datee?></p></td>
                    </tr>
                    <tr> 
                    <td class="meta-head">Vouch by</td>
                    <td><p id="cash"><?php echo $byyy?></p></td>
                </tr>   <tr> 
                            <td class="meta-head">Total Vouch</td>
                            <td><p id="cash"><?php echo $amo?></p></td>
                        </tr>
                         
        
                    </table>
                
                </div>
                
                <br><br>
                <br><br>
                <br><br>    
                <center>
                <table id="items">
                
                                        <tr>  
                                            <th style="width:70%">Item Description</th>
                                            <th class="numeric ">Amount</th> 
                                        </tr> 
                                    <tbody id="tbodyvoucher">
                                    <?php $query = mysqli_query($con,"SELECT * FROM t_org_voucher a
INNER JOIN t_org_voucher_items b on a.OrgVoucher_CASH_VOUCHER_NO = b.OrgVouchItems_VOUCHER_NO
AND a.OrgVoucher_ORG_CODE ='$orgcode' and a.OrgVoucher_CASH_VOUCHER_NO ='$vouch'"); while($row = mysqli_fetch_assoc($query)){ ?> 
                                    <tr class="item-row">
                                        <!-- <td><?php echo (new DateTime($row["OrgVouchItems_DATE_ADD"]))->format('D M d, Y ') ?></td> -->
                                        <td><?php echo $row["OrgVouchItems_ITEM_NAME"] ?></td>
                                        <td><?php echo "₱ ".$row["OrgVouchItems_AMOUNT"] ?></td>
                                    </tr>
<?php }?>
                                    </tbody>

                                </table> 
                <br><br>
                <br><br>  
                                </center>


            </div>
        </div>
    </div>