<?php

	include('../../../config/connection.php');
		$appcode = $_POST['_appcode'];
        $catcode = $_POST['_catcode'];

        $view_query = mysqli_query($con,"(SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode')  ");
        while($row2 = mysqli_fetch_assoc($view_query))
        {   

        
            $code = $row2["OrgForCompliance_ORG_CODE"];            
            $query = mysqli_query($con,"INSERT INTO t_assign_org_non_academic (AssOrgNonAcademic_ORG_CODE,AssOrgNonAcademic_NON_ACAD) 
                                            VALUES ('$code','$catcode')  ");            
        
        }

?>
