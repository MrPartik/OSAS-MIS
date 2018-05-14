<?php
	
	include('../../../config/connection.php');
	
	$view_query = mysqli_query($con,"select CONCAT('Finan',RIGHT(100000+count(FinAssiTitle_ID)+1,5)) CODE from `r_financial_assistance_title`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		echo $code;

?>