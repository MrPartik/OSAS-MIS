<?php
	
    include('../../../config/connection.php');     
	if(isset($_POST['_code']))
	{
		$code = $_POST['_code'];
		$pos = $_POST['_pos'];
		$desc = $_POST['_desc'];
		$occ = $_POST['_occ'];

        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_DESC,OrgOffiPosDetails_NumOfOcc)  VALUES ('$code','$pos','$desc','$occ')");

        
	}

?>
