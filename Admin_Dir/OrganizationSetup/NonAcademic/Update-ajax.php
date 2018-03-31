<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_org_non_academic_details` SET OrgNonAcad_NAME = '$name',OrgNonAcad_DESC = '$desc',OrgNonAcad_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgNonAcad_CODE = '$code'");

	}

?>