<?php
	
	include('../../connection.php');

		$view_query = mysqli_query($connection,"select CONCAT('REQ',RIGHT(100000+count(OrgAccrDetail_ID)+1,5)) CODE from `r_org_accreditation_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>