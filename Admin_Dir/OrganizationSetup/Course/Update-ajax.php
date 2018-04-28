<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$tval = $_POST['_year'];
		$code = $_POST['_code'];
		

        $query = mysqli_prepare($con, "UPDATE `r_courses` SET Course_NAME = ?,Course_DESC = ?,Course_CURR_YEAR = ?,Course_DATE_MOD = CURRENT_TIMESTAMP WHERE Course_CODE = ?");
        mysqli_stmt_bind_param($query, 'ssss', $name,$desc,$tval,$code);
        mysqli_stmt_execute($query);

	}
    else
    {
        
        include('../../../Retrict.php');
        
    }

?>
