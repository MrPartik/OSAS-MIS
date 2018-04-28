<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE `r_clearance_signatories` SET ClearSignatories_NAME = '$name',ClearSignatories_DESC = '$desc',ClearSignatories_DATE_MOD = CURRENT_TIMESTAMP WHERE ClearSignatories_CODE = '$code'");

        $query = mysqli_prepare($con, "UPDATE `r_clearance_signatories` SET ClearSignatories_NAME = ?,ClearSignatories_DESC = ?,ClearSignatories_DATE_MOD = CURRENT_TIMESTAMP WHERE ClearSignatories_CODE = ?");
        mysqli_stmt_bind_param($query, 'sss',$name,$desc, $code);
        mysqli_stmt_execute($query);

	}
    else
    {
        
        include('../../../Retrict.php');
        
    }

?>