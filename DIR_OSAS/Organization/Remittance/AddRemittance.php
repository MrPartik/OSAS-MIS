<?php
	
    include('../../../config/connection.php');     

    $orgcode = $_POST['_orgcode'];
    $sendby = $_POST['_sendby'];
    $recby = $_POST['_recby'];
    $amount = $_POST['_amount'];
    $desc = $_POST['_desc'];
    $remarks = $_POST['_remarks'];
    session_start();
    $id = $_SESSION['logged_user']['username'];
    $view_query = mysqli_query($con," SELECT OSASHead_NAME FROM r_osas_head INNER JOIN r_users ON Users_REFERENCED = OSASHead_CODE WHERE Users_USERNAME = '$id' ");
    while($row = mysqli_fetch_assoc($view_query))
        $id = $row['OSASHead_NAME'];

    $view_query = mysqli_query($con," (SELECT CONCAT('Remit #', RIGHT(((SELECT COUNT(*) + 1 FROM `t_org_remittance` )+100000),5) ) AS REMIT) ");
    $row = mysqli_fetch_assoc($view_query);
    $remit = $row['REMIT'];

    $remarks = 'Received by: ' .$id ;
    $query = mysqli_query($con,"INSERT INTO t_org_remittance (OrgRemittance_NUMBER,OrgRemittance_ORG_CODE,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,OrgRemittance_AMOUNT,OrgRemittance_DESC) VALUES ('$remit','$orgcode','$sendby','$id','$amount','$desc')   ");
    
    echo $remarks;

    $query = mysqli_query($con,"INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_COLLECTION,OrgCashFlowStatement_REMARKS) VALUES ('$orgcode','$remit','$amount','$remarks')");
    echo $remarks;
    


?>
