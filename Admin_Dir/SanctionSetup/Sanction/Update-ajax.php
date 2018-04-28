<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$time = $_POST['_time'];
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE `r_sanction_details` SET SancDetails_NAME = ?,SancDetails_DESC = ?,SancDetails_TIMEVAL = ?,SancDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE SancDetails_CODE = ?");
        mysqli_stmt_bind_param($query, 'ssss', $name, $desc,$time, $code);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>