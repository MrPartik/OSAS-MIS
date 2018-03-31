<?php

	include('../../../config/connection.php');
		$appcode = $_POST['_appcode'];
        $catcode = $_POST['_catcode'];
        $coucoude = $_POST['_coucode'];
      
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_ORG_CODE = '$appcode' AND AssOrgAcademic_COURSE_CODE = '$coucoude'  ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
        
            $cou = $row["COU"];
        
        }


        if($cou == '0')
        {
            
             $query = mysqli_query($con,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE) 
                                                VALUES ('$appcode','$coucoude')  ");            
        }
        else
        {
            
             $query = mysqli_query($con,"UPDATE t_assign_org_academic_course SET AssOrgAcademic_DISPLAY_STAT = 'Active'
                                                WHERE AssOrgAcademic_ORG_CODE = '$appcode' AND AssOrgAcademic_COURSE_CODE=  '$coucoude'  ");                                    
        }

?>
