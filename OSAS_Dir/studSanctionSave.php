<?php 
include('../config/query.php');
include ('../config/connection.php'); 
if(isset($_POST['insertSanction']))
{
    $StudNumber = $_POST['StudNumber'];
    $SanctionCode=$_POST['SanctionCode'];
     $DesignatedOfficeCode=$_POST['DesignatedOfficeCode'];
    $Cons=$_POST['Cons']; 
    $Finish=$_POST['Finish']; 
    $sancRemarks=$_POST['SancRemarks'];
    $done = (new DateTime( $_POST['Done']))->format('Y-m-d H:i:s');  
   mysqli_query($con,"call Insert_AssignSanction('$StudNumber','$SanctionCode','$DesignatedOfficeCode',$Cons,'$Finish','$sancRemarks','$done')"); 
 
} 
if(isset($_POST['updateSanction']))
{
    $ID=$_POST['ID'];
    $Cons=$_POST['Cons']; 
    $Finish=$_POST['finish'];   
    $sancRemarks=$_POST['SancRemarks'];
    $done = (new DateTime( $_POST['Done']))->format('Y-m-d H:i:s');  
        mysqli_query($con,"call Update_AssignSanction($ID,$Cons,'$Finish','$sancRemarks','$done')");  
  
        
} 
if(isset($_POST['archiveSanction']))
{
    $ID = $_POST['ID'];  
   mysqli_query($con,"call  Archive_AssignSanction($ID)");
}
if(isset($_POST['insertSanctionDetails']))
{
    $Code = $_POST['Code'];  
    $Name = $_POST['Name'];  
    $Desc = $_POST['SDesc'];  
    $Time = $_POST['Time'];  
   mysqli_query($con,"call  Insert_SanctionDetails('$Code','$Name','$Desc',$Time)");
}
if(isset($_POST['insertDesiDetails']))
{
    $Code = $_POST['Code'];  
    $Name = $_POST['Name'];  
    $Desc = $_POST['SDesc'];   
   mysqli_query($con,"call  Insert_DesignatedOffice('$Code','$Name','$Desc')");
}
?>