<?php
	
    include('../../config/connection.php');     

    $studno = $_POST['_studno'];
    $appcode = $_POST['_appcode'];
    $pos = $_POST['_pos'];

    $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_assign_org_members` WHERE AssOrgMem_STUD_NO = '$studno' AND AssOrgMem_APPL_ORG_CODE = '$appcode' ");

    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];

        if($cou == '1')
            $query = mysqli_query($con,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Active',AssOrgMem_DATE_MOD = CURRENT_TIMESTAMP WHERE AssOrgMem_STUD_NO = '$studno' AND AssOrgMem_APPL_ORG_CODE = '$appcode' ");
        else        
            $query = mysqli_query($con,"INSERT INTO t_assign_org_members (AssOrgMem_STUD_NO,AssOrgMem_APPL_ORG_CODE)  VALUES ('$studno','$appcode')");

    }

    if($pos != 'default')
    {
        
            $query = mysqli_query($con,"INSERT INTO t_org_officers (OrgOffi_OrgOffiPosDetails_ID,OrgOffi_STUD_NO)  VALUES ('$pos','$studno')");

        
    }


    
?>
