<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE r_courses SET Course_DISPLAY_STAT = 'Inactive',Course_DATE_MOD = CURRENT_TIMESTAMP WHERE Course_CODE = '$code'");

	}

?>
