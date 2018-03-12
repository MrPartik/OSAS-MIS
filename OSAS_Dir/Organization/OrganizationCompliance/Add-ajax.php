<?php
	
	include('../../connection.php');
	if(isset($_POST['_code']))
	{
		$code = $_POST['_code'];
		$compcode = $_POST['_compcode'];
		$appname = $_POST['_name'];
		$advname = $_POST['_advname'];
		$drpyear = $_POST['_drpyear'];
		$drpcatname = $_POST['_drpcatname'];
		$drpcatcode = $_POST['_drpcatcode'];
		$drpcou = $_POST['_drpcou'];
        $mission = $_POST['_mission'];
		$vision = $_POST['_vision'];
        
        $split = str_split($appname);
        $acr = '';
        $flag = 0;
        foreach ($split as $data )
        {
            if($flag == 0)
            {        
                $acr = $acr . $data;
                $flag = 1;
            }
            else if($data == ' ')
            {
                $flag = 0;
            }

        }
        $acr = strtoupper($acr); 
        
        $view_query = mysqli_query($connection,"SELECT COUNT(*) AS COU FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Inactive' AND OrgForCompliance_ORG_CODE = CONCAT('$acr',YEAR(CURRENT_DATE))");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count = $row["COU"];

        }

        if($count == 0)
        {
            
            $query = mysqli_query($connection,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_ADVISER,OrgForCompliance_BATCH_YEAR)  VALUES (CONCAT('$acr',YEAR(CURRENT_DATE)),'$code','$advname','$drpyear')");
            
        }
        else
        {
            $query = mysqli_query($connection,"UPDATE t_org_for_compliance SET OrgForCompliance_ADVISER = '$advname',OrgForCompliance_BATCH_YEAR = '$drpyear',OrgForCompliance_DATE_ADD = CURRENT_TIMESTAMP,OrgForCompliance_DATE_MOD = CURRENT_TIMESTAMP , OrgForCompliance_DISPAY_STAT = 'Active',OrgForCompliance_OrgApplProfile_APPL_CODE = '$code' WHERE OrgForCompliance_ORG_CODE = CONCAT('$acr',YEAR(CURRENT_DATE))");
        
            
        }


        $query = mysqli_query($connection,"INSERT INTO t_assign_org_category (AssOrgCategory_ORG_CODE,AssOrgCategory_ORGCAT_CODE)  VALUES (CONCAT('$acr',YEAR(CURRENT_DATE)),'$drpcatcode')");
        
        
        if($drpcatname == 'Academic Organization')
            $query = mysqli_query($connection,"INSERT INTO t_assign_org_academic_course (AssOrgAcademic_ORG_CODE,AssOrgAcademic_COURSE_CODE)  VALUES (CONCAT('$acr',YEAR(CURRENT_DATE)),'$drpcou')");

        $query = mysqli_query($connection,"INSERT INTO r_org_essentials (OrgEssentials_ORG_CODE,OrgEssentials_MISSION,OrgEssentials_VISION)  VALUES (CONCAT('$acr',YEAR(CURRENT_DATE)),'$mission','$vision')");


        $query = mysqli_query($connection,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED) SELECT CONCAT('$acr',YEAR(CURRENT_DATE)), OrgAccrDetail_CODE, '0' FROM r_org_accreditation_details WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'");            

        
	}

?>
