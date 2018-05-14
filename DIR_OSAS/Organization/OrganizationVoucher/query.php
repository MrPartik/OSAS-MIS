<?php 

     
    include('../../../config/connection.php'); 
    $VoucherNo="";
    $OrgCode ="";
    if(isset($_POST['voucherNo'])){
    $VoucherNo = $_POST['voucherNo'];
    }
    if(isset($_POST['OrgCode'])){
    $OrgCode = $_POST['OrgCode'];
    }

    if(isset($_POST['approve'])){
        mysqli_query($con,"update t_org_voucher set OrgVoucher_STATUS ='Approved' where OrgVoucher_CASH_VOUCHER_NO ='$VoucherNo' ");
    }
    if(isset($_POST['reject'])){
        mysqli_query($con,"update t_org_voucher set OrgVoucher_STATUS ='Rejected' where OrgVoucher_CASH_VOUCHER_NO ='$VoucherNo' ");
    }

?>