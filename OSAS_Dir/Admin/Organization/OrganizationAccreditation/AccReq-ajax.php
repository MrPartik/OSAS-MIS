<?php
	
	include('../../connection.php');
	if(isset($_POST['_drpcode']))
	{

		$compcode = $_POST['_drpcode'];
		$reccode = $_POST['_reccode'];
		$stat = $_POST['_stat'];

        $query = mysqli_query($connection,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED)  VALUES ('$compcode','$reccode','$stat')");

        
	}

?>
