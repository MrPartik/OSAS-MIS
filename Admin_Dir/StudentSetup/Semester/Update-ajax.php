<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_semester` SET Semestral_NAME = '$name', Semestral_DESC = '$desc', Semestral_DATE_MOD = CURRENT_TIMESTAMP WHERE Semestral_CODE = '$code'");

	}

?>
