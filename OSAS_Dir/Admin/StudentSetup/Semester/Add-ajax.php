<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		
		$view_query = mysqli_query($connection,"select CONCAT('SEM',RIGHT(100000+count(Semestral_ID)+1,5)) CODE from `r_semester`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}
		
		$query = mysqli_query($connection,"INSERT INTO `r_semester` (Semestral_CODE,Semestral_NAME,Semestral_DESC) VALUES ('$code','$name','$desc')");

	}

?>
