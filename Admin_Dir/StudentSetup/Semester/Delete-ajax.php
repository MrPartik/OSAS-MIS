<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_semester` SET Semestral_DISPLAY_STAT = 'Inactive',Semestral_DATE_MOD = CURRENT_TIMESTAMP WHERE Semestral_CODE = '$code'");

	}

?>
