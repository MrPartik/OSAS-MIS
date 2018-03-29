<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_org_category SET OrgCat_DISPLAY_STAT = 'Active',OrgCat_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgCat_CODE = '$code'");

	}

?>
