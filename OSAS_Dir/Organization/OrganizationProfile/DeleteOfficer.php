<?php
	
    include('../../../config/connection.php');     
	if( isset($_POST['_studno']) )
	{
	
		$studno = $_POST['_studno'];
		$posid = $_POST['_posid'];
		
		$query = mysqli_query($con,"UPDATE t_org_officers SET OrgOffi_DISPLAY_STAT = 'Inactive' WHERE OrgOffi_OrgOffiPosDetails_ID = '$posid' AND OrgOffi_STUD_NO = '$studno' ");
	}

?>
