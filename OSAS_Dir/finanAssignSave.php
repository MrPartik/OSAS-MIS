<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertFinanAss']))
{
    $StudNumber = $_POST['StudNumber'];
    $FinanAssTitle=$_POST['FinanAssTitle'];
     $FinanAssStat=$_POST['FinanAssStat'];
    $FinanAssRemarks=$_POST['FinanAssRemarks'];  
   mysqli_query($con,"call Insert_AssignFinancialAss('$StudNumber','$FinanAssTitle','$FinanAssStat','$FinanAssRemarks')"); 
} 
if(isset($_POST['updateFinanAss']))
{
    $ID = $_POST['ID']; 
     $FinanAssStat=$_POST['FinanAssStat'];
    $FinanAssRemarks=$_POST['FinanAssRemarks'];  
   mysqli_query($con,"call Update_AssignFinancialAss($ID,'$FinanAssStat','$FinanAssRemarks')"); 
} 
if(isset($_POST['archiveFinanAss']))
{
    $ID = $_POST['ID'];   
   mysqli_query($con,"call Archive_FinancialAss($ID)"); 
} 

?>