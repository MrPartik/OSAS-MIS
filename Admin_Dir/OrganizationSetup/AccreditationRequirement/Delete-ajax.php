<?php
	
	include('../.././config/connection.php');
	if( isset($_POST['_code']) )
	{
		$code = $_POST['_code'];
		
		$query = mysqli_query($con,"UPDATE r_org_accreditation_details SET OrgAccrDetail_DISPLAY_STAT = 'Inactive',OrgAccrDetail_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrDetail_CODE = '$code'");
        
       	$query = mysqli_query($con,"UPDATE t_org_accreditation_process SET OrgAccrProcess_DISPLAY_STAT = 'Inactive',OrgAccrProcess_DATE_MOD = CURRENT_TIMESTAMP WHERE OrgAccrProcess_OrgAccrDetail_CODE = '$code'");
        

	}

?>
