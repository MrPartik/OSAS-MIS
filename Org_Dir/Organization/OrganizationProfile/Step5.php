<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_drpcode']))
	{

		$appcode = $_POST['_drpcode'];
		$reccode = $_POST['_reccode'];
		$stat = $_POST['_stat'];


        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode') AND OrgAccrProcess_OrgAccrDetail_CODE = '$reccode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
        
            $cou = $row["COU"];
        
        }    
    
        if($cou == 0)
        {
            $query = mysqli_query($con,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED)  VALUES ((SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode'),'$reccode','$stat')");
                
        }
        else
        {
            $query = mysqli_query($con,"UPDATE t_org_accreditation_process SET OrgAccrProcess_IS_ACCREDITED = '$stat' 
                                            WHERE OrgAccrProcess_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode') AND OrgAccrProcess_OrgAccrDetail_CODE = '$reccode' ");

            
        }
        
        $view_query = mysqli_query($con,"SELECT WIZARD_CURRENT_STEP AS CUR FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode') ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $cur  = $row["CUR"];

        }

        if($cur < 5 )
        {
            $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = 5 WHERE WIZARD_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$appcode') ");

        }    
        
	}

?>
