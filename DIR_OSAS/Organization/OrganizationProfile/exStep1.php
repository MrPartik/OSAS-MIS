<?php

	include('../../../config/connection.php');

		
		$name = $_POST['_orgname'];
		$year = $_POST['_year'];
		$appcode = $_POST['_appcode'];
        $compcode = substr($appcode,0,strlen($appcode)-4) . substr($year,0,4) ;

        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU,OrgForCompliance_OrgApplProfile_APPL_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND  OrgForCompliance_ORG_CODE = '$appcode'");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count  = $row["COU"];
            if($count != '0' )
                $compcode = $row["OrgForCompliance_OrgApplProfile_APPL_CODE"]; 
        }
 
        if($count == '0')
        {
             $query = mysqli_query($con,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_BATCH_YEAR,OrgForCompliance_ADVISER) 
                                                VALUES ('$appcode','$compcode','$year',null)  ");
            
        }
        else
        {
             $query = mysqli_query($con,"UPDATE t_org_for_compliance SET OrgForCompliance_BATCH_YEAR = '$year'
                                        WHERE OrgForCompliance_ORG_CODE =  '$appcode' ");
            
        }
       
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = '$appcode'");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count  = $row["COU"];
        
        }

        if($count == '0')
        {
             $query = mysqli_query($con,"INSERT INTO r_application_wizard (WIZARD_ORG_CODE,WIZARD_CURRENT_STEP) 
                                                VALUES ('$appcode','2')  ");
            
        }

  



?>
