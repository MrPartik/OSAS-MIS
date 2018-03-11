<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$year = $_POST['_year'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_org_category` SET OrgCat_NAME = '$name',OrgCat_DESC = '$desc',OrgCat_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgCat_CODE = '$code'");

	}

?>