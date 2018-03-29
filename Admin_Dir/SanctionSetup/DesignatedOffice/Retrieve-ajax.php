<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE r_designated_offices_details SET DesOffDetails_DISPLAY_STAT = 'Active',DesOffDetails_DATE_MOD = CURRENT_TIMESTAMP  WHERE  DesOffDetails_CODE = '$code'");

	}

?>
