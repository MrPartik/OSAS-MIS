<?php
	
	include('../../connection.php');

		$view_query = mysqli_query($connection,"select CONCAT('POS',RIGHT(100000+count(OrgOffiPosDetails_ID)+1,5)) CODE from `r_org_officer_position_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>