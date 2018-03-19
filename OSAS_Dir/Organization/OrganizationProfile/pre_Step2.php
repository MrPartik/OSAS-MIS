<?php

	include('../../../config/connection.php');

		
		$appcode = $_POST['_appcode']; 
        $query = mysqli_query($con,"UPDATE t_assign_org_academic_course SET AssOrgAcademic_DISPLAY_STAT = 'Inactive' WHERE AssOrgAcademic_ORG_CODE = '$appcode'  "); 

    echo $compcode;

?>
