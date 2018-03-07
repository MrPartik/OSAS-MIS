<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE r_sanction_details SET SancDetails_DISPLAY_STAT = 0 WHERE SancDetails_CODE = '$code'");

	}

?>