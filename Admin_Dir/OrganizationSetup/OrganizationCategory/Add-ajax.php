<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
			
		
		$query = mysqli_query($con,"INSERT INTO `r_org_category` (OrgCat_CODE,OrgCat_NAME,OrgCat_DESC) VALUES ('$code','$name','$desc')");

	}

?>
