<?php
	
	include('../../../config/connection.php');
	if(isset($_POST['_compcode']))
	{

		$compcode = $_POST['_compcode'];
		$reccode = $_POST['_reccode'];
		$stat = $_POST['_stat'];
        
// $result = mysqli_query($connection, "select count(*) as cou from t_org_accreditation_process WHERE OrgAccrProcess_ORG_CODE = '$compcode' and OrgAccrProcess_OrgAccrDetail_CODE = '$reccode'"); // while($row = mysqli_fetch_assoc($view_query)) // { // $cou = $row["cou"]; // } // // if(cou == 0)          
        $query = mysqli_query($con,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED)  VALUES ('$compcode','$reccode','$stat')");
//        else
//            $query = mysqli_query($connection,"Update t_org_accreditation_process SET OrgAccrProcess_IS_ACCREDITED = '$stat' WHERE OrgAccrProcess_ORG_CODE =  '$compcode' and OrgAccrProcess_OrgAccrDetail_CODE = '$reccode'");

        
	}

?>
