<?php
	
	include('../../config/connection.php');
	if(isset($_POST['_code']) )
	{
		$code = $_POST['_code'];

        $year = '0';
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM active_academic_year WHERE ActiveAcadYear_Batch_YEAR = '$code' ") ;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $year = $row["COU"];

        }
        $query = mysqli_query($con,"UPDATE `active_academic_year` SET ActiveAcadYear_IS_ACTIVE = '0' ");

        
        if($year == '0')
            $query = mysqli_query($con,"INSERT INTO `active_academic_year` (ActiveAcadYear_Batch_YEAR,ActiveAcadYear_IS_ACTIVE) VALUES ('$code',1) ");
        else
            $query = mysqli_query($con,"UPDATE `active_academic_year` SET ActiveAcadYear_IS_ACTIVE = '1' WHERE ActiveAcadYear_Batch_YEAR = '$code' ");

        mysqli_query($con,"update `t_org_for_compliance` set OrgForCompliance_DISPAY_STAT = 'Inactive' ");
        mysqli_query($con,"update `t_org_for_compliance` set OrgForCompliance_DISPAY_STAT = 'Active' where OrgForCompliance_BATCH_YEAR = '$code'");
        mysqli_query($con,"update `r_users` set Users_DISPLAY_STAT = 'Inactive' where Users_REFERENCED in (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Inactive'  )");

        mysqli_query($con,"update `r_users` set Users_DISPLAY_STAT = 'Active' where Users_REFERENCED in (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active'  )");


	}

?>
