<?php
	
    include('../../../config/connection.php');     

    $id = $_POST['_id'];
    $orgcode = $_POST['_orgcode'];
    $sendby = $_POST['_sendby'];
    $recby = $_POST['_recby'];
    $amount = $_POST['_amount'];
    $desc = $_POST['_desc'];

    $query = mysqli_query($con,"UPDATE t_org_remittance SET OrgRemittance_ORG_CODE = '$orgcode' ,OrgRemittance_SEND_BY = '$sendby' ,OrgRemittance_AMOUNT = '$amount',OrgRemittance_DESC = '$desc',OrgRemittance_DATE_MOD = CURRENT_TIMESTAMP  WHERE OrgRemittance_ID = '$id' ");

?>
