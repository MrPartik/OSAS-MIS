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
    mysqli_query($con,"INSERT INTO `log_sanction` (`LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_SEMESTER`, `LogSanc_ACAD_YEAR`, `LogSanc_IS_FINISH`,`LogSanc_TO_BE_DONE`) 
    VALUES ((select max(AssSancStudStudent_ID) from t_assign_stud_saction where AssSancStudStudent_DISPLAY_STAT = 'Active'),$Cons,'$sancRemarks','$current_semster','$current_acadyear','$Finish','$done')");
 
} 
if(isset($_POST['updateSanction']))
{
    $ID=$_POST['ID'];
    $Cons=$_POST['Cons']; 
    $Finish=$_POST['finish'];   
    $sancRemarks=$_POST['SancRemarks'];
    $done = (new DateTime( $_POST['Done']))->format('Y-m-d H:i:s');  
    mysqli_query($con,"call Update_AssignSanction($ID,$Cons,'$Finish','$sancRemarks','$done')");  
    mysqli_query($con,"INSERT INTO `log_sanction` (`LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_SEMESTER`, `LogSanc_ACAD_YEAR`, `LogSanc_IS_FINISH`,`LogSanc_TO_BE_DONE`) 
    VALUES ($ID,$Cons,'$sancRemarks','$current_semster','$current_acadyear','$Finish','$done')");
 
         
} 
if(isset($_POST['archiveSanction']))
{
    $ID=$_POST['ID'];
    $Cons=$_POST['Cons']; 
    $Finish=$_POST['finish'];   
    $sancRemarks=$_POST['SancRemarks'];
    $done = (new DateTime( $_POST['Done']))->format('Y-m-d H:i:s');  
    mysqli_query($con,"call  Archive_AssignSanction($ID)"); 
    mysqli_query($con,"INSERT INTO `log_sanction` (`LogSanc_AssSancSudent_ID`, `LogSanc_CONSUMED_HOURS`, `LogSanc_REMARKS`, `LogSanc_SEMESTER`, `LogSanc_ACAD_YEAR`, `LogSanc_IS_FINISH`,`LogSanc_TO_BE_DONE`) 
    VALUES ($ID,$Cons,'$sancRemarks - Already Archived','$current_semster','$current_acadyear','$Finish','$done')");
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
