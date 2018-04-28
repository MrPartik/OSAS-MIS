<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$time = $_POST['_time']; 
		
        $query = mysqli_prepare($con, "INSERT INTO `r_sanction_details` (SancDetails_CODE,SancDetails_NAME,SancDetails_DESC,SancDetails_TIMEVAL) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($query, 'ssss', $code, $name,$time, $desc);
        mysqli_stmt_execute($query);
        
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>