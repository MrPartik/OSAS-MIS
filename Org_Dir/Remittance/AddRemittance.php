<?php
	
    include('../../../config/connection.php');     

    $orgcode = $_POST['_orgcode'];
    $sendby = $_POST['_sendby'];
    $recby = $_POST['_recby'];
    $amount = $_POST['_amount'];
    $desc = $_POST['_desc'];

    $query = mysqli_query($con,"INSERT INTO t_org_remittance (OrgRemittance_ORG_CODE,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,OrgRemittance_AMOUNT,OrgRemittance_DESC) VALUES ('$orgcode','$sendby','$recby','$amount','$desc')   ");

?>
