<?php
	
    include('../../../config/connection.php');     

    $studno = $_POST['_studno'];
    $pos = $_POST['_pos'];
    
    $view_query = mysqli_query($con," SELECT COUNT(*) AS COU FROM `t_org_officers` WHERE OrgOffi_OrgOffiPosDetails_ID = '$pos' AND OrgOffi_STUD_NO = '$studno' ");
    while($row = mysqli_fetch_assoc($view_query))
    {
         $cou = $row["COU"];
    }

if($cou == 0)
    $query = mysqli_query($con,"INSERT INTO t_assign_org_members (AssOrgMem_STUD_NO,AssOrgMem_COMPL_ORG_CODE)  VALUES ('$studno',(SELECT OrgOffiPosDetails_ORG_CODE FROM r_org_officer_position_details WHERE OrgOffiPosDetails_ID = '$pos'))");


if($cou == 0)
    $query = mysqli_query($con,"INSERT INTO t_org_officers (OrgOffi_OrgOffiPosDetails_ID,OrgOffi_STUD_NO)  VALUES ('$pos','$studno')");
else
    $query = mysqli_query($con,"UPDATE t_org_officers SET OrgOffi_DISPLAY_STAT = 'Active' WHERE OrgOffi_OrgOffiPosDetails_ID = '$pos' AND OrgOffi_STUD_NO = '$studno' ");


    
?>
