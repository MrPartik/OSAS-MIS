<?php
	
	include('../../../config/connection.php');

		$view_query = mysqli_query($con,"select CONCAT('CAT',RIGHT(100000+count(OrgCat_ID)+1,5)) CODE from `r_org_category`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>