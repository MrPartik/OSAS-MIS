<?php
	
	include('../../../config/connection.php');     

	if(isset($_POST['_name']) )
	{
        $id = $_POST['_id'];
        $code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$catcode = $_POST['_catcode'];
		$accstat = $_POST['_accstat'];
        $curorgcode = '';
        $curcompcode = '';
        


        $query = mysqli_query($con,"UPDATE r_org_applicant_profile SET OrgAppProfile_NAME = '$name',OrgAppProfile_DESCRIPTION = '$desc',OrgAppProfile_STATUS = '$accstat' WHERE OrgAppProfile_APPL_CODE  = '$id' ");
                
        $query = mysqli_query($con,"UPDATE t_assign_org_category SET AssOrgCategory_ORGCAT_CODE = '$catcode' WHERE AssOrgCategory_ORG_CODE IN (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$id')  ");            

        
	}

?>
