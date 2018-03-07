<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$pos = $_POST['_pos'];
		$org = $_POST['_org'];
		$desc = $_POST['_desc'];
		$year = $_POST['_year'];
		$view_query = mysqli_query($connection,"select CONCAT('POS',RIGHT(100000+count(OrgOffiPosDetails_ID)+1,5)) CODE from `r_org_officer_position_details`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}			
		
		$query = mysqli_query($connection,"INSERT INTO `r_org_officer_position_details` (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_DESC,OrgOffiPosDetails_BATCH_YEAR) VALUES ('$org','$pos','$desc','$year')");

	}

?>
