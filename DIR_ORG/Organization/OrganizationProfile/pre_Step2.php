<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode'];

        $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode'");


        while($row = mysqli_fetch_assoc($view_query))
        {   
        
            $compcode = $row["OrgForCompliance_ORG_CODE"];
        
        }


        $query = mysqli_query($con,"UPDATE t_assign_org_academic_course SET AssOrgAcademic_DISPLAY_STAT = 'Inactive' WHERE AssOrgAcademic_ORG_CODE = '$compcode'  "); 

    echo $compcode;


        
  


?>
