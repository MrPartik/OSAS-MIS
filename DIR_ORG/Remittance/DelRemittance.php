<?php
	
    include('../../../config/connection.php');     

    $id = $_POST['_id'];

    $query = mysqli_query($con,"UPDATE t_org_remittance SET OrgRemittance_DISPLAY_STAT = 'Inactive' WHERE OrgRemittance_ID = '$id' ");

?>
