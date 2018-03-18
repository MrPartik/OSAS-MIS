<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode'];
        $vision = $_POST['_vision'];
        $mission = $_POST['_mission'];



        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `r_org_essentials` WHERE OrgEssentials_ORG_CODE =  '$appcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
        
            $cou = $row["COU"];
        
        } 
        if($cou == '0')
        {
            
             $query = mysqli_query($con,"INSERT INTO r_org_essentials (OrgEssentials_ORG_CODE,OrgEssentials_MISSION,OrgEssentials_VISION)   VALUES ('$appcode','$mission','$vision')  ");            
        }
        else
        {
            
             $query = mysqli_query($con,"UPDATE r_org_essentials SET OrgEssentials_MISSION = '$mission' ,OrgEssentials_VISION = '$vision' WHERE OrgEssentials_ORG_CODE = '$appcode'");                                    
        }



        $view_query = mysqli_query($con,"SELECT WIZARD_CURRENT_STEP AS CUR FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = '$appcode'");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $cur  = $row["CUR"];

        }

        $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = 5 WHERE WIZARD_ORG_CODE = = '$appcode'");


?>
