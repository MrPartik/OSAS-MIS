<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode'];
        $catcode = $_POST['_catcode']; 
 
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_assign_org_category` WHERE AssOrgCategory_ORG_CODE = '$appcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
        
            $cou = $row["COU"];
        
        }


        if($cou == '0')
        {
            
             $query = mysqli_query($con,"INSERT INTO t_assign_org_category (AssOrgCategory_ORG_CODE,AssOrgCategory_ORGCAT_CODE) 
                                                VALUES ('$appcode','$catcode')  ");            
        }
        else
        {
            
             $query = mysqli_query($con,"UPDATE t_assign_org_category SET AssOrgCategory_ORGCAT_CODE = '$catcode'
                                                WHERE AssOrgCategory_ORG_CODE = '$appcode' ");                                    
        }
        
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU,WIZARD_CURRENT_STEP AS CUR FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = '$appcode'");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $cur  = $row["CUR"];
            $cou  = $row["COU"];
        
        }

        if($cou == 0)
        {
             $query = mysqli_query($con,"INSERT INTO r_application_wizard (WIZARD_ORG_CODE,WIZARD_CURRENT_STEP) 
                                                VALUES ('$appcode','3')  ");
            
            
        }
        else
        {
            if($cur < 3 )
            {
                 $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = 3 WHERE WIZARD_ORG_CODE = '$appcode' ");

            }       

        }
        echo $appcode;


?>
