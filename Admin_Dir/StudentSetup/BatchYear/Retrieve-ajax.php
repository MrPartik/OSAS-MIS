<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE `r_batch_details` SET Batch_DISPLAY_STAT = 'Active' WHERE Batch_YEAR = ?");
        mysqli_stmt_bind_param($query, 's', $code);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
