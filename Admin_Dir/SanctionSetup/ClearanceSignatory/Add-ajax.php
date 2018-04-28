<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_name']) && isset($_POST['_desc']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$name=$_POST['_name'];
		$desc=$_POST['_desc'];

		$view_query = mysqli_query($con,"select CONCAT('SIG',RIGHT(100000+count(ClearSignatories_ID)+1,5)) CODE from `r_clearance_signatories`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}			
		
        $query = mysqli_prepare($con, "INSERT INTO `r_clearance_signatories` (ClearSignatories_CODE,ClearSignatories_NAME,ClearSignatories_DESC) VALUES (?,?,?)");
        mysqli_stmt_bind_param($query, 'sss', $code,$name,$desc);
        mysqli_stmt_execute($query);

	}
    else
    {
        
        include('../../../Retrict.php');
        
    }

?>