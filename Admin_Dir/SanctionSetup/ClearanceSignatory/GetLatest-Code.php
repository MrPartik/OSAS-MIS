<?php
	
	include('../../connection.php');

		$view_query = mysqli_query($connection,"select CONCAT('SIG',RIGHT(100000+count(ClearSignatories_ID)+1,5)) CODE from `r_clearance_signatories`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>