<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertVouch']))
{
    
    $orgcode=$_POST['orgcode'];
    $vouchBy=$_POST['vouchBy'];
    $vouch=$_POST['vouch'];  
    $amo=$_POST['amount'];
    $remarks=$_POST['remarks'];

   mysqli_query($con,"call Insert_Voucher('$vouch','$orgcode','$vouchBy')")or die(mysql_error());
   
   mysqli_query($con,"INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_EXPENSES,OrgCashFlowStatement_REMARKS) VALUES ('$orgcode','$vouch','$amo',concat('Received by: ','$remarks'))")or die("INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_EXPENSES,OrgCashFlowStatement_REMARKS) VALUES ('$orgcode','$vouch','$amo',concat('Received by: ','$remarks'))")or die(mysql_error());; 
   
   
} 
if(isset($_POST['insertVouchItem']))
{
    
    $vouch=$_POST['vouch'];  
    $desc=$_POST['desc'];
    $amou=$_POST['amou']; 
   mysqli_query($con,"call Insert_Voucher_Item('$vouch','$desc','$amou')")or die(mysql_error());  
} 

 

?>