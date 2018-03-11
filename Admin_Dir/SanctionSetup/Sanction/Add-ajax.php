<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$time = $_POST['_time'];
		$view_query = mysqli_query($connection,"select CONCAT('SANC',RIGHT(100000+count(SancDetails_ID)+1,5)) CODE from `r_sanction_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}			
		
		$query = mysqli_query($connection,"INSERT INTO `r_sanction_details` (SancDetails_CODE,SancDetails_NAME,SancDetails_DESC,SancDetails_TIMEVAL) VALUES ('$code','$name','$desc','$time')");

	}

?>