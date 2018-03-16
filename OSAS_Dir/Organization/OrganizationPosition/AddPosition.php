<?php
	
    include('../../../config/connection.php');
	if(isset($_POST['_code']))
	{
		$code = $_POST['_code'];
		$pos = $_POST['_pos'];
		$desc = $_POST['_desc'];

        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_DESC)  VALUES ('$code','$pos','$desc')");

        
	}

?>
