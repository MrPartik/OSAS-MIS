<?php
	
	include('../../../config/connection.php');

		$view_query = mysqli_query($con,"select CONCAT('BAT',RIGHT(100000+count(Batch_ID)+1,5)) CODE from `r_batch_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>