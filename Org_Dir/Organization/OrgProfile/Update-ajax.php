<?php
	
	include('../../../config/connection.php'); 
	if(isset($_POST['_name']) )
	{
        $id = $_POST['_id'];
        $code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
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
        $curcompcode = '';
        


        $query = mysqli_query($connection,"UPDATE r_org_applicant_profile SET OrgAppProfile_APPL_CODE = '$code',OrgAppProfile_NAME = '$name',OrgAppProfile_DESCRIPTION = '$desc',OrgAppProfile_STATUS = '$accstat' WHERE OrgAppProfile_ID = $id ");
                
        $view_query = mysqli_query($connection,"SELECT OAP.OrgAppProfile_APPL_CODE AS ORGCODE,OFC.OrgForCompliance_ORG_CODE AS COMPCODE FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE =  OAP.OrgAppProfile_APPL_CODE  WHERE OrgAppProfile_ID = $id ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $curorgcode = $row["ORGCODE"];
            $curcompcode = $row["COMPCODE"];

        }        
        $query = mysqli_query($connection,"UPDATE t_org_for_compliance SET OrgForCompliance_ORG_CODE = '$compcode',OrgForCompliance_OrgApplProfile_APPL_CODE = '$code',OrgForCompliance_ADVISER = '$advname',OrgForCompliance_BATCH_YEAR = '$drpyear' WHERE OrgForCompliance_ORG_CODE = '$curcompcode'  ");

        $query = mysqli_query($connection,"UPDATE t_assign_org_category SET AssOrgCategory_ORG_CODE = '$compcode',AssOrgCategory_ORGCAT_CODE = '$drpcatcode' WHERE AssOrgCategory_ORG_CODE = '$curcompcode' ");
        
//        if($drpcatname == 'Academic Organization')
//            $query = mysqli_query($connection,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");
//
//        $query = mysqli_query($connection,"INSERT INTO r_org_essentials (OrgEssentials_ORG_CODE,OrgEssentials_MISSION,OrgEssentials_VISION)  VALUES ('$compcode','$mission','$vision')");
        
        if($drpcatname == 'Academic Organization')
        {
         
            $view_query = mysqli_query($connection,"SELECT COUNT(*) AS COU FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode'");
            while($row = mysqli_fetch_assoc($view_query))
            {   
                $count = $row["COU"];

            }
            
            if($count == 0)
                $query = mysqli_query($connection,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");
            else
                $query = mysqli_query($connection," UPDATE t_assign_org_academic_course SET AssOrgAcademic_ORG_CODE = '$compcode',AssOrgAcademic_COURSE_CODE = '$drpcou' WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$curcompcode'");
             
            
        }
        else
        {
            
            $view_query = mysqli_query($connection,"SELECT COUNT(*) AS COU FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT = 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode'");
            while($row = mysqli_fetch_assoc($view_query))
            {   
                $count = $row["COU"];

            }
            
            if($count == 1)
                $query = mysqli_query($connection," UPDATE t_assign_org_academic_course SET AssOrgAcademic_DISPLAY_STAT = 'Inactive' WHERE AssOrgAcademic_ORG_CODE = '$curcompcode'");
             
            
        }
        
	}

?>
