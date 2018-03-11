<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$time = $_POST['_time']; 
		
		$query = mysqli_query($con,"INSERT INTO `r_sanction_details` (SancDetails_CODE,SancDetails_NAME,SancDetails_DESC,SancDetails_TIMEVAL) VALUES ('$code','$name','$desc','$time')");

	}

?>