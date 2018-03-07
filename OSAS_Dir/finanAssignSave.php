<?php 
include('../config/query.php');
include ('../config/connection.php'); 

if(isset($_POST['insertFinanAss']))
{
    $StudNumber = $_POST['StudNumber'];
    $FinanAssTitle=$_POST['FinanAssTitle'];
     $FinanAssStat=$_POST['FinanAssStat'];
    $FinanAssRemarks=$_POST['FinanAssRemarks'];  
   mysql_query("call Insert_AssignFinancialAss('$StudNumber','$FinanAssTitle','$FinanAssStat','$FinanAssRemarks')"); 
} 
if(isset($_POST['updateFinanAss']))
{
    $ID = $_POST['ID']; 
     $FinanAssStat=$_POST['FinanAssStat'];
    $FinanAssRemarks=$_POST['FinanAssRemarks'];  
   mysql_query("call Update_AssignFinancialAss($ID,'$FinanAssStat','$FinanAssRemarks')"); 
} 
if(isset($_POST['archiveFinanAss']))
{
    $ID = $_POST['ID'];   
   mysql_query("call Archive_FinancialAss($ID)"); 
} 

?>