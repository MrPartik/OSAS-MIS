<?php
	
    include('../../../config/connection.php');     
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		$orgcode = $_POST['_orgcode'];
		
		$query = mysqli_query($con,"UPDATE r_org_officer_position_details SET OrgOffiPosDetails_DISPLAY_STAT = 'Inactive' WHERE OrgOffiPosDetails_ORG_CODE = '$orgcode' and OrgOffiPosDetails_NAME = '$code'");

	}

?>
