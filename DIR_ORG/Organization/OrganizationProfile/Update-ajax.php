<?php
	
	include('../../../config/connection.php');     

	if(isset($_POST['_name']) )
	{
        $id = $_POST['_id'];
        $code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$accstat = $_POST['_accstat'];
        $curorgcode = '';
        $curcompcode = '';
        


        $query = mysqli_query($con,"UPDATE r_org_applicant_profile SET OrgAppProfile_NAME = '$name',OrgAppProfile_DESCRIPTION = '$desc',OrgAppProfile_STATUS = '$accstat' WHERE OrgAppProfile_APPL_CODE  = '$id' ");
                

        
	}

?>
