<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$year = $_POST['_year'];
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "INSERT INTO `r_courses` (Course_CODE,Course_NAME,Course_DESC,Course_CURR_YEAR) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($query, 'ssss', $code, $name, $desc,$year);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }

?>
