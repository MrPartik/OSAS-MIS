<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_org_accreditation_details SET OrgAccrDetail_NAME = '$name',OrgAccrDetail_DESC = '$desc', OrgAccrDetail_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrDetail_CODE = '$code'");

	}

?>