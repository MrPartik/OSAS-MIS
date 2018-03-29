<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertVouch']))
{
    
    $orgcode=$_POST['orgcode'];
    $vouchBy=$_POST['vouchBy'];
    $vouch=$_POST['vouch'];  
   mysqli_query($con,"call Insert_Voucher($vouch,'$orgcode','$vouchBy')"); 
} 
if(isset($_POST['insertVouchItem']))
{
    
    $vouch=$_POST['vouch'];  
    $desc=$_POST['desc'];
    $amou=$_POST['amou']; 
   mysqli_query($con,"call Insert_Voucher_Item($vouch,'$desc','$amou')"); 
} 

?>