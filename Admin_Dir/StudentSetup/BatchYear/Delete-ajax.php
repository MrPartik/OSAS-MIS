<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_batch_details` SET Batch_DISPLAY_STAT = 'Inactive' WHERE Batch_CODE = '$code'");

	}

?>
