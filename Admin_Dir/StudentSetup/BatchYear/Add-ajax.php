<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		
		$view_query = mysqli_query($con,"select CONCAT('BAT',RIGHT(100000+count(Batch_ID)+1,5)) CODE from `r_batch_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}

		$query = mysqli_query($con,"INSERT INTO `r_batch_details` (Batch_YEAR,Batch_DESC) VALUES ('$name','$desc')");

	}

?>
