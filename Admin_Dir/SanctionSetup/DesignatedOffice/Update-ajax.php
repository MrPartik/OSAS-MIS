<?php
	
	include('../../connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && isset($_POST['_code'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE `r_designated_offices_details` SET DesOffDetails_NAME = ?,DesOffDetails_DESC = ?,DesOffDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE DesOffDetails_CODE = ?");
        mysqli_stmt_bind_param($query, 'sss', $name, $desc, $code);
        mysqli_stmt_execute($query);

	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>