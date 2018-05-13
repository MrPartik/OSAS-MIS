<?php
	
	include('../../../config/connection.php'); 
	if(isset($_POST['_code']))
	{
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

        $query = mysqli_query($connection,"INSERT INTO r_org_applicant_profile (OrgAppProfile_APPL_CODE,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION,OrgAppProfile_STATUS)  VALUES ('$code','$name','$desc','$accstat')");
        

        $query = mysqli_query($connection,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_ADVISER,OrgForCompliance_BATCH_YEAR)  VALUES ('$compcode','$code','$advname','$drpyear')");


        $query = mysqli_query($connection,"INSERT INTO t_assign_org_category (AssOrgCategory_ORG_CODE,AssOrgCategory_ORGCAT_CODE)  VALUES ('$compcode','$drpcatcode')");
        
        
        if($drpcatname == 'Academic Organization')
            $query = mysqli_query($connection,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES ('$compcode','$drpcou')");

        $query = mysqli_query($connection,"INSERT INTO r_org_essentials (OrgEssentials_ORG_CODE,OrgEssentials_MISSION,OrgEssentials_VISION)  VALUES ('$compcode','$mission','$vision')");

        
	}

?>
