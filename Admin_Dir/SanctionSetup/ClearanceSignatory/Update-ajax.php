<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_clearance_signatories` SET ClearSignatories_NAME = '$name',ClearSignatories_DESC = '$desc',ClearSignatories_DATE_MOD = CURRENT_TIMESTAMP WHERE ClearSignatories_CODE = '$code'");

	}

?>