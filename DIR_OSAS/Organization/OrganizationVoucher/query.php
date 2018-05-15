<?php 

     
    include('../../../config/connection.php');
    session_start();
    $id = $_SESSION['logged_user']['username'];
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

        $VouchMoneyNoQuery = mysqli_fetch_assoc(mysqli_query($con,"SELECT sum(OrgVouchItems_AMOUNT) as amou FROM `t_org_voucher_items` WHERE OrgVouchItems_VOUCHER_NO ='$VoucherNo'"));

        $VouchMoney =$VouchMoneyNoQuery['amou'];

        mysqli_query($con,"INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_EXPENSES,OrgCashFlowStatement_REMARKS) VALUES ('$OrgCode','$VoucherNo','$VouchMoney',concat('Received by: ','$id'))");



    }
    if(isset($_POST['reject'])){
        mysqli_query($con,"update t_org_voucher set OrgVoucher_STATUS ='Rejected' where OrgVoucher_CASH_VOUCHER_NO ='$VoucherNo' ");
    }

?>
