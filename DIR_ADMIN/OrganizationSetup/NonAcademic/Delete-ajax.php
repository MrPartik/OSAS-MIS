<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_org_non_academic_details SET OrgNonAcad_DISPLAY_STAT = 'Inactive',OrgNonAcad_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgNonAcad_CODE = '$code'");

	}

?>
