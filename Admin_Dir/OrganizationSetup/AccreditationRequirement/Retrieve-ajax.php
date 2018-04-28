<?php
	
	include('../../../config/connection.php');
	if( isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$code = $_POST['_code'];
		

        $query = mysqli_prepare($con, "UPDATE r_org_accreditation_details SET OrgAccrDetail_DISPLAY_STAT = 'Active',OrgAccrDetail_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrDetail_CODE =  ?");
        mysqli_stmt_bind_param($query, 's', $code);
        
        $query = mysqli_prepare($con, "UPDATE t_org_accreditation_process SET OrgAccrProcess_DISPLAY_STAT = 'Active',OrgAccrProcess_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrProcess_OrgAccrDetail_CODE = ?");
        mysqli_stmt_bind_param($query, 's', $code);
        mysqli_stmt_execute($query);


	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
?>
