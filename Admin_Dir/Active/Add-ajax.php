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
/*
        $view_query = mysqli_query($con,"SELECT * FROM r_application_wizard ") ;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $code = $row["WIZARD_ORG_CODE"];
            $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = '-1' WHERE WIZARD_ORG_CODE = '$code' ");       

            
        }
*/
        


	}

?>
