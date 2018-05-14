<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode'];
		$advname = $_POST['_advname'];
        $cur = 0;
        $query = mysqli_query($con,"UPDATE t_org_for_compliance SET OrgForCompliance_ADVISER = '$advname'
                                                WHERE OrgForCompliance_ORG_CODE = '$appcode' AND OrgForCompliance_DISPAY_STAT = 'Active' ");                                    

        $view_query = mysqli_query($con,"SELECT WIZARD_CURRENT_STEP AS CUR FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = '$appcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $cur  = $row["CUR"];
          
        }

        if($cur < 2 )
        {
             $query = mysqli_query($con,"INSERT INTO r_application_wizard (WIZARD_CURRENT_STEP,WIZARD_ORG_CODE) VALUES ('2','$appcode') ");

        }       
        
        mysqli_query($con,"call Insert_Users('$appcode','$appcode','Organization','$appcode') "); 


    


?>
