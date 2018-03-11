<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$time = $_POST['_time'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_sanction_details` SET SancDetails_NAME = '$name',SancDetails_DESC = '$desc',SancDetails_TIMEVAL = '$time',SancDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE SancDetails_CODE = '$code'");

	}

?>