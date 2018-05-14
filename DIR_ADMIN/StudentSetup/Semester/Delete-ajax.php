<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE `r_semester` SET Semestral_DISPLAY_STAT = 'Inactive',Semestral_DATE_MOD = CURRENT_TIMESTAMP WHERE Semestral_NAME = ? ");
        mysqli_stmt_bind_param($query, 's', $code);
        mysqli_stmt_execute($query);
        
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }

?>
