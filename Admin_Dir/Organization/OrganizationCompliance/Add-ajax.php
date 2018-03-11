<?php
	
	include('../../connection.php');
	if(isset($_POST['_code']))
	{
		$code = $_POST['_code'];
		$compcode = $_POST['_compcode'];
		$advname = $_POST['_advname'];
		$drpyear = $_POST['_drpyear'];
		$drpcatname = $_POST['_drpcatname'];
		$drpcatcode = $_POST['_drpcatcode'];
		$drpcou = $_POST['_drpcou'];
        $mission = $_POST['_mission'];
		$vision = $_POST['_vision'];


        
        $view_query = mysqli_query($connection,"SELECT COUNT(*) AS COU FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Inactive' AND OrgForCompliance_ORG_CODE = '$compcode'");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count = $row["COU"];

        }

        if($count == 0)
        {
            
            $query = mysqli_query($connection,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_ADVISER,OrgForCompliance_BATCH_YEAR)  VALUES ('$compcode','$code','$advname','$drpyear')");
            
        }
        else
        {
            $query = mysqli_query($connection,"UPDATE t_org_for_compliance SET OrgForCompliance_ADVISER = '$advname',OrgForCompliance_BATCH_YEAR = '$drpyear',OrgForCompliance_DATE_ADD = CURRENT_TIMESTAMP,OrgForCompliance_DATE_MOD = CURRENT_TIMESTAMP , OrgForCompliance_DISPAY_STAT = 'Active',OrgForCompliance_OrgApplProfile_APPL_CODE = '$code' WHERE OrgForCompliance_ORG_CODE = '$compcode'");
        
            
        }



        $query = mysqli_query($connection,"INSERT INTO t_assign_org_category (AssOrgCategory_ORG_CODE,AssOrgCategory_ORGCAT_CODE)  VALUES ('$compcode','$drpcatcode')");
        
        
        if($drpcatname == 'Academic Organization')
            $query = mysqli_query($connection,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");

        $query = mysqli_query($connection,"INSERT INTO r_org_essentials (OrgEssentials_ORG_CODE,OrgEssentials_MISSION,OrgEssentials_VISION)  VALUES ('$compcode','$mission','$vision')");


        $query = mysqli_query($connection,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED) SELECT '$compcode', OrgAccrDetail_CODE, '0' FROM r_org_accreditation_details WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'");            

        
	}

?>
