<?php
	
include('../../../config/connection.php');     

	if(isset($_POST['_name']))
	{
		
        
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$batchyear = $_POST['_year'];
		$catcode = $_POST['_catcode'];
        
        $split = str_split($name);
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
        $acr = $acr . substr($batchyear,0,4);
        $query = mysqli_query($con,"INSERT INTO r_org_applicant_profile (OrgAppProfile_APPL_CODE,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION) VALUES ('$acr','$name','$desc')");

        $query = mysqli_query($con,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_BATCH_YEAR) VALUES ('$acr',(SELECT OrgAppProfile_APPL_CODE FROM `r_org_applicant_profile` WHERE OrgAppProfile_ID = (SELECT MAX(OrgAppProfile_ID) FROM `r_org_applicant_profile` WHERE OrgAppProfile_DISPLAY_STAT = 'Active')),'$batchyear')  ");       

                    
        $query = mysqli_query($con,"INSERT INTO t_assign_org_category (AssOrgCategory_ORG_CODE,AssOrgCategory_ORGCAT_CODE) VALUES ('$acr','$catcode')  ");    

        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','President','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Vice-President of internal affair','1')  ");       
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Vice-President of external affair','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Budget and Finance','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Auditor','1')  ");       
        
        
        echo $acr;
        
	}
    
?>
