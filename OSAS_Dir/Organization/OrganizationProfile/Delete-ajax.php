<?php
	
	include('../../../config/connection.php');     

	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE t_org_for_compliance SET OrgForCompliance_DISPAY_STAT = 'Inactive', OrgForCompliance_DATE_MOD	 = CURRENT_TIMESTAMP WHERE OrgForCompliance_ORG_CODE = '$code'");

	}

?>
