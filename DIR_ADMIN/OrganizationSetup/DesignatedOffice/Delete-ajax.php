<?php
	
	include('../../../../config/connection.php'); 
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE r_org_category SET OrgCat_DISPLAY_STAT = 'Inactive' WHERE OrgCat_CODE = '$code'");

	}

?>
