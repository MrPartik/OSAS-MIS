<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_sanction_details SET SancDetails_DISPLAY_STAT = 0 WHERE SancDetails_CODE = '$code'");

	}

?>