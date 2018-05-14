<?php
	
	include('../../../config/connection.php');

		$view_query = mysqli_query($con,"select CONCAT('COU',RIGHT(100000+count(Course_ID)+1,5)) CODE from `r_courses`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>