<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertVouch']))
{ 
    $orgcode=trim($_POST['orgcode']);
    $vouchBy=$_POST['vouchBy'];
    $vouch=trim($_POST['vouch']);  
    $amo=$_POST['amount'];
    $remarks=$_POST['remarks']; 
    
   mysqli_query($con,"call Insert_Voucher('$vouch','$orgcode','$vouchBy')")or die(mysql_error());
    
   
   mysqli_query($con,"INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES ('$vouch','Organization','$orgcode',(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'))")or die(mysql_error());
   
   
} 
if(isset($_POST['insertVouchItem']))
{
    
    $vouch=$_POST['vouch'];  
    $desc=$_POST['desc'];
    $amou=$_POST['amou']; 
   mysqli_query($con,"call Insert_Voucher_Item('$vouch','$desc','$amou')")or die(mysql_error());  
} 

 

?>