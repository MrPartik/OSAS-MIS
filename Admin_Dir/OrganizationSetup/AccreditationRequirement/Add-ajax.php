<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name=$_POST['_name'];
		$desc=$_POST['_desc'];

		$view_query = mysqli_query($connection,"select CONCAT('REQ',RIGHT(100000+count(OrgAccrDetail_ID)+1,5)) CODE from `r_org_accreditation_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}			
		
		$query = mysqli_query($connection,"INSERT INTO r_org_accreditation_details (OrgAccrDetail_CODE,OrgAccrDetail_NAME,OrgAccrDetail_DESC) VALUES ('$code','$name','$desc')");

	}

?>