<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		
        $query = mysqli_prepare($con, "INSERT INTO `r_batch_details` (Batch_YEAR,Batch_DESC) VALUES (?,?)");
        mysqli_stmt_bind_param($query, 'ss', $name, $desc);
        mysqli_stmt_execute($query);
        
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
