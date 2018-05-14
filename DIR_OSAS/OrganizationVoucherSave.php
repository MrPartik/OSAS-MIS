<?php 
include('../config/query.php');
include ('../config/connection.php'); 

session_start();
$Username = $_SESSION['logged_user']['username'];
if(isset($_POST['insertVouch']))
{
    
    $orgcode=$_POST['orgcode'];
    $vouchBy=$_POST['vouchBy'];
    $vouch=$_POST['vouch'];  
    $amo=$_POST['amount'];
    $remarks=$_POST['remarks'];
    
   mysqli_query($con,"INSERT INTO `t_org_voucher` (`OrgVoucher_CASH_VOUCHER_NO`, `OrgVoucher_ORG_CODE`,`OrgVoucher_VOUCHED_BY`,`OrgVoucher_STATUS`,`OrgVoucher_CHECKED_BY`) VALUES ( '$vouch','$orgcode','$vouchBy','Approved','$Username')")or die(mysql_error());

   mysqli_query($con,"INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_EXPENSES,OrgCashFlowStatement_REMARKS) VALUES ('$orgcode','$vouch','$amo',concat('Received by: ','$remarks'))")or die("INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_EXPENSES,OrgCashFlowStatement_REMARKS) VALUES ('$orgcode','$vouch','$amo',concat('Received by: ','$remarks'))")or die(mysql_error());

   
   mysqli_query($con,"INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES ('$vouch','OSAS Head','$orgcode',(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'))")or die(mysql_error());
   
   
} 
if(isset($_POST['insertVouchItem']))
{
    
    $vouch=$_POST['vouch'];  
    $desc=$_POST['desc'];
    $amou=$_POST['amou']; 
   mysqli_query($con,"call Insert_Voucher_Item('$vouch','$desc','$amou')")or die(mysql_error());  
} 

 

?>