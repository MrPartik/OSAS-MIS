<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$year = $_POST['_year'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"INSERT INTO `r_courses` (Course_CODE,Course_NAME,Course_DESC,Course_CURR_YEAR) VALUES ('$code','$name','$desc','$year')");

	}

?>
