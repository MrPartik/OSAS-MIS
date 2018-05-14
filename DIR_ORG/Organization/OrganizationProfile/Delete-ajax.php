<?php
	
	include('../../../config/connection.php');     

	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_org_applicant_profile SET OrgAppProfile_DISPLAY_STAT = 'Inactive',OrgAppProfile_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAppProfile_APPL_CODE = '$code'");

	}

?>
