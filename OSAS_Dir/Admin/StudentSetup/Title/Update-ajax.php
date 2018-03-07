<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($connection,"UPDATE `r_financial_assistance_title` SET FinAssiTitle_NAME = '$name', FinAssiTitle_DESC = '$desc', FinAssiTitle_DATE_MOD = CURRENT_TIMESTAMP WHERE FinAssiTitle_CODE = '$code'");

	}

?>
