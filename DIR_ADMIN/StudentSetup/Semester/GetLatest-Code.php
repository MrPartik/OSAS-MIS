<?php
	
	include('../../../config/connection.php');

		$view_query = mysqli_query($con,"select CONCAT('SEM',RIGHT(100000+count(Semestral_ID)+1,5)) CODE from `r_semester`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>
