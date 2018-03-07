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
   mysql_query("call Insert_AssignSanction('$StudNumber','$SanctionCode','$DesignatedOfficeCode',$Cons,'$Finish','$sancRemarks')"); 
} 
if(isset($_POST['updateSanction']))
{
    $ID=$_POST['ID'];
    $Cons=$_POST['Cons']; 
    $Finish=$_POST['finish'];   
    $sancRemarks=$_POST['SancRemarks'];
        mysql_query("call Update_AssignSanction($ID,$Cons,'$Finish','$sancRemarks')"); 
  
        
} 
if(isset($_POST['archiveSanction']))
{
    $ID = $_POST['ID'];  
   mysql_query("call  Archive_AssignSanction($ID)");
}
if(isset($_POST['insertSanctionDetails']))
{
    $Code = $_POST['Code'];  
    $Name = $_POST['Name'];  
    $Desc = $_POST['SDesc'];  
    $Time = $_POST['Time'];  
   mysql_query("call  Insert_SanctionDetails('$Code','$Name','$Desc',$Time)");
}
if(isset($_POST['insertDesiDetails']))
{
    $Code = $_POST['Code'];  
    $Name = $_POST['Name'];  
    $Desc = $_POST['SDesc'];   
   mysql_query("call  Insert_DesignatedOffice('$Code','$Name','$Desc')");
}
?>