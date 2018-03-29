<?php
	
    include('../../config/connection.php');     

    $studno = $_POST['_studno'];
    $appcode = $_POST['_appcode'];
    $pos = $_POST['_pos'];

     $view_query = mysqli_query($con,"(SELECT COUNT(*) AS COU FROM `r_org_officer_position_details` 
 INNER JOIN t_org_officers AS B ON B.OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID
 	WHERE OrgOffiPosDetails_ORG_CODE = '$appcode' AND OrgOffi_STUD_NO = '$studno') ");
    $cou = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];

    }
    
    if($cou != 0)
    {
         $view_query = mysqli_query($con,"(SELECT B.OrgOffi_ID AS GETID FROM `r_org_officer_position_details` 
                INNER JOIN t_org_officers AS B ON B.OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID
                    WHERE OrgOffiPosDetails_ORG_CODE = '$appcode' AND OrgOffi_STUD_NO = '$studno') ");
        $getid = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $getid = $row["GETID"];

        }
        if($pos != 'default')
            $query = mysqli_query($con,"UPDATE t_org_officers SET OrgOffi_OrgOffiPosDetails_ID = '$pos', OrgOffi_DISPLAY_STAT = 'Active',OrgOffi_DATE_MODIFIED = CURRENT_TIMESTAMP WHERE OrgOffi_ID = '$getid'  ");
        else
            $query = mysqli_query($con,"UPDATE t_org_officers SET OrgOffi_DISPLAY_STAT = 'Inactive',OrgOffi_DATE_MODIFIED = CURRENT_TIMESTAMP WHERE OrgOffi_ID = '$getid'  ");
        
    }
    else
    {
        if($pos != 'default')
        $query = mysqli_query($con,"INSERT INTO t_org_officers (OrgOffi_OrgOffiPosDetails_ID,OrgOffi_STUD_NO)  VALUES ('$pos','$studno')");

    }
    
?>
