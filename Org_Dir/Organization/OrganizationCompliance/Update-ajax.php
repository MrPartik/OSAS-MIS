<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_compcode']) )
	{
		$accstat = $_POST['_accstat'];
		$compcode = $_POST['_compcode'];
		$advname = $_POST['_advname'];
		$drpyear = $_POST['_drpyear'];
		$drpcatname = $_POST['_drpcatname'];
		$drpcatcode = $_POST['_drpcatcode'];
		$drpcou = $_POST['_drpcou'];
		$mission = $_POST['_mission'];
		$vision = $_POST['_vision'];
        $curorgcode = '';
                        
          
        $query = mysqli_query($con,"UPDATE t_org_for_compliance SET OrgForCompliance_ADVISER = '$advname',OrgForCompliance_BATCH_YEAR = '$drpyear' WHERE OrgForCompliance_ORG_CODE = '$compcode'  ");

        $query = mysqli_query($con,"UPDATE t_assign_org_category SET AssOrgCategory_ORGCAT_CODE = '$drpcatcode' WHERE AssOrgCategory_ORG_CODE = '$compcode' ");
        
//        if($drpcatname == 'Academic Organization')
//            $query = mysqli_query($con,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");
//
        $query = mysqli_query($con,"UPDATE r_org_essentials SET OrgEssentials_MISSION = '$mission',OrgEssentials_VISION = '$vision' WHERE OrgEssentials_ORG_CODE = '$compcode' ");
        
        if($drpcatname == 'Academic Organization')
        {
         
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode'");
            while($row = mysqli_fetch_assoc($view_query))
            {   
                $count = $row["COU"];

            }
            
            if($count == 0)
                $query = mysqli_query($con,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");
            else
                $query = mysqli_query($con," UPDATE t_assign_org_academic_course SET AssOrgAcademic_ORG_CODE = '$compcode',AssOrgAcademic_COURSE_CODE = '$drpcou' WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode'");
             
            
        }
        else
        {
            
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode'");
            while($row = mysqli_fetch_assoc($view_query))
            {   
                $count = $row["COU"];

            }
            
            if($count == 1)
                $query = mysqli_query($con," UPDATE t_assign_org_academic_course SET AssOrgAcademic_DISPLAY_STAT = 'Inactive' WHERE AssOrgAcademic_ORG_CODE = '$compcode'");
             
            
        }
        
	}

?>
