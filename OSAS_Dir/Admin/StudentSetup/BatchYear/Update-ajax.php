<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_batch_details` SET Batch_YEAR = '$name', Batch_DESC = '$desc' WHERE Batch_CODE = '$code'");

	}

?>