<?php
	
	include('../../../config/connection.php');

		$view_query = mysqli_query($con,"select CONCAT('SANC',RIGHT(100000+count(SancDetails_ID)+1,5)) CODE from `r_sanction_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>