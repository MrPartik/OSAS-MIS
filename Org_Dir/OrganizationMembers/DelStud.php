<?php
	
    include('../../config/connection.php');     

    $studno = $_POST['_studno'];
    $appcode = $_POST['_appcode'];
		
    $query = mysqli_query($con,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Inactive' WHERE AssOrgMem_STUD_NO = '$studno' AND AssOrgMem_APPL_ORG_CODE = '$appcode' ");

    $view_query = mysqli_query($con,"(SELECT B.OrgOffi_ID AS GETID FROM `r_org_officer_position_details` 
 INNER JOIN t_org_officers AS B ON B.OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID
 	WHERE OrgOffiPosDetails_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode' AND OrgOffi_STUD_NO = '$studno' ) AND OrgOffi_STUD_NO = '$studno') ");
    $getid = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $getid = $row["GETID"];


    }
    $query = mysqli_query($con,"UPDATE t_org_officers SET OrgOffi_DISPLAY_STAT = 'Inactive' WHERE OrgOffi_ID = '$getid' ");
    
    


?>
