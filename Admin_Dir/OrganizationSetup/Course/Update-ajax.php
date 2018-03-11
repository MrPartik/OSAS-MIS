<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$tval = $_POST['_year'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_courses` SET Course_NAME = '$name',Course_DESC = '$desc',Course_CURR_YEAR = '$tval',Course_DATE_MOD = CURRENT_TIMESTAMP WHERE Course_CODE = '$code'");

	}

?>
