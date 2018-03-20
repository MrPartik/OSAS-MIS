<?php
	
    include('../../../config/connection.php');     
	if(isset($_POST['_pos']))
	{
		$pos = $_POST['_pos'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		$org = $_POST['_orgcode'];
		
		$query = mysqli_query($con,"UPDATE `r_org_officer_position_details` SET OrgOffiPosDetails_NAME = '$pos',OrgOffiPosDetails_DESC = '$desc',OrgOffiPosDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgOffiPosDetails_NAME = '$code' AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = '$org'");

	}

?>
