<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE r_sanction_details SET SancDetails_DISPLAY_STAT = 'Inactive',SancDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE SancDetails_CODE = ?");
        mysqli_stmt_bind_param($query, 's', $code);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
