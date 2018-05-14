<?php

	include('../../../config/connection.php');
		$appcode = $_POST['_appcode'];
        $catcode = $_POST['_catcode'];
      
         $query = mysqli_query($con,"INSERT INTO t_assign_org_non_academic (AssOrgNonAcademic_ORG_CODE,AssOrgNonAcademic_NON_ACAD)  VALUES ('$appcode','$catcode')  ");            
?>
