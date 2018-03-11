<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE r_org_accreditation_details SET OrgAccrDetail_DISPLAY_STAT = 0,OrgAccrDetail_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrDetail_CODE = '$code'");

	}

?>