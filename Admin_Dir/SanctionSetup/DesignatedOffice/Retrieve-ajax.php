<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE r_designated_offices_details SET DesOffDetails_DISPLAY_STAT = 'Active',DesOffDetails_DATE_MOD = CURRENT_TIMESTAMP  WHERE  DesOffDetails_CODE =  ?");
        mysqli_stmt_bind_param($query, 's', $code);
        mysqli_stmt_execute($query);
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
