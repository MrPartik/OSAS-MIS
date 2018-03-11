<?php
	
	include('../../connection.php');
	if(isset($_POST['_code']))
	{
		$code = $_POST['_code'];
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$accstat = $_POST['_accstat'];
        $query = mysqli_query($connection,"INSERT INTO r_org_applicant_profile (OrgAppProfile_APPL_CODE,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION,OrgAppProfile_STATUS)  VALUES ('$code','$name','$desc','$accstat')");
        
    
	}

?>
