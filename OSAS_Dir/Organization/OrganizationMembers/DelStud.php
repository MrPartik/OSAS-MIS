<?php
	
    include('../../../config/connection.php');

    $studno = $_POST['_studno'];
    $appcode = $_POST['_appcode'];
		
    $query = mysqli_query($con,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Inactive' WHERE AssOrgMem_STUD_NO = '$studno' AND AssOrgMem_APPL_ORG_CODE = '$appcode' ");


?>
