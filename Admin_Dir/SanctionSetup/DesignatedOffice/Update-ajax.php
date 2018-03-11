<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_designated_offices_details` SET DesOffDetails_NAME = '$name',DesOffDetails_DESC = '$desc',DesOffDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE DesOffDetails_CODE = '$code'");

	}

?>