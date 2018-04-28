<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$code = $_POST['_code'];
			
        $query = mysqli_prepare($con, "INSERT INTO `r_org_category` (OrgCat_CODE,OrgCat_NAME,OrgCat_DESC) VALUES (?,?,?)");
        mysqli_stmt_bind_param($query, 'sss', $code, $name, $desc);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
