<?php
	
	include('../../connection.php');

		$view_query = mysqli_query($connection,"select CONCAT('OFF',RIGHT(100000+count(DesOffDetails_ID)+1,5)) CODE from `r_designated_offices_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>