<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $VoucherNo = $_POST['item'];
        session_start();
        $id = $_SESSION['logged_user']['username']; 
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            mysqli_query($con,"update t_org_voucher set OrgVoucher_STATUS ='Rejected' where OrgVoucher_CASH_VOUCHER_NO ='$VoucherNo'");  

            $orgNoQuery = mysqli_fetch_assoc(mysqli_query($con,"SELECT OrgVoucher_ORG_CODE FROM ` t_org_voucher` WHERE OrgVoucher_CASH_VOUCHER_NO ='$VoucherNo'")); 

            $orgCode =$orgNoQuery['OrgVoucher_ORG_CODE']; 

            mysqli_query($con,"INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES ('$VoucherNo','Organization',(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'),'$orgCode')");  
 
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
