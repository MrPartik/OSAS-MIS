<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name=$_POST['_name'];
		$desc=$_POST['_desc'];

		$view_query = mysqli_query($connection,"select CONCAT('OFF',RIGHT(100000+count(DesOffDetails_ID)+1,5)) CODE from `r_designated_offices_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}			
		
		$query = mysqli_query($connection,"INSERT INTO `r_designated_offices_details` (DesOffDetails_CODE,DesOffDetails_NAME,DesOffDetails_DESC) VALUES ('$code','$name','$desc')");

	}

?>