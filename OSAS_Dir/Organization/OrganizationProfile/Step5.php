<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode'];


        $view_query = mysqli_query($con,"SELECT WIZARD_CURRENT_STEP AS CUR FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = '$appcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $cur  = $row["CUR"];
          
        }

        if($cur < 5 )
        {
             $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = 5 WHERE WIZARD_ORG_CODE = '$appcode' ");

        }       


  


?>
