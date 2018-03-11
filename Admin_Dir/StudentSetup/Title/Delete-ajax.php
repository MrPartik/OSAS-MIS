<?php
	
	include('../../connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_financial_assistance_title` SET FinAssiTitle_DISPLAY_STAT = 'Inactive',FinAssiTitle_DATE_MOD = CURRENT_TIMESTAMP WHERE FinAssiTitle_CODE = '$code'");

	}

?>
