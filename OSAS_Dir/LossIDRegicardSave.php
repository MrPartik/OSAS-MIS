<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertLossAss']))
{
    $LossType = $_POST['LossType'];
    $LossClaimDate= new DateTime( $_POST['LossClaim']);
    $LossClaim =  $LossClaimDate->format('Y-m-d H:i:s');
    $StudNumber=$_POST['StudNumber'];
    $LossRemarks=$_POST['LossRemarks'];  
   mysqli_query($con,"call Insert_LossIDRegi('$StudNumber','$LossType','$LossClaim','$LossRemarks')"); 
} 
if(isset($_POST['updateLossAss']))
{
    $ID = $_POST['ID'];  
    $LossClaimDate= new DateTime( $_POST['LossClaim']);
    $LossClaim =  $LossClaimDate->format('Y-m-d H:i:s');  
    $LossRemarks=$_POST['LossRemarks'];  
   mysqli_query($con,"call Update_LossIDRegi($ID,'$LossClaim','$LossRemarks')"); 
} 
if(isset($_POST['archiveLossAss']))
{
    $ID = $_POST['ID'];   
   mysqli_query($con,"call Archive_LossIDRegi($ID)"); 
} 

?>