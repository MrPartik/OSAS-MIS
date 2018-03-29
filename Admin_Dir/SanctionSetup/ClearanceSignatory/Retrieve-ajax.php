<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_clearance_signatories SET ClearSignatories_DISPLAY_STAT = 'Active',ClearSignatories_DATE_MOD = CURRENT_TIMESTAMP WHERE ClearSignatories_CODE = '$code'");

	}

?>
