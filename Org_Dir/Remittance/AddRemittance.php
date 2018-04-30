<?php
	
    $con = mysqli_connect("localhost","root","","osas"); 
    //$orgcode = $_POST['_orgcode'];
    session_start();
    $orgcode = $_SESSION['logged_user']['username'];
    $sendby = $_POST['_sendby'];
    $recby = '';
    $amount = $_POST['_amount'];
    $desc = $_POST['_desc'];

    $view_query = mysqli_query($con," (SELECT CONCAT('Remit #', RIGHT(((SELECT COUNT(*) + 1 FROM `t_org_remittance` )+100000),5) ) AS REMIT) ");
    $row = mysqli_fetch_assoc($view_query);
    $remit = $row['REMIT'];

    $query = mysqli_prepare($con, "INSERT INTO t_org_remittance (OrgRemittance_NUMBER,OrgRemittance_ORG_CODE,OrgRemittance_SEND_BY,OrgRemittance_AMOUNT,OrgRemittance_DESC,OrgRemittance_APPROVED_STATUS) VALUES (?,?,?,?,?,'Pending')");
    mysqli_stmt_bind_param($query, 'sssss', $remit, $orgcode,$sendby,$amount,$desc);
    mysqli_stmt_execute($query);
    
    $query = mysqli_prepare($con, "INSERT INTO r_notification (Notification_ITEM) VALUES (?)");
    mysqli_stmt_bind_param($query, 's', $remit);
    mysqli_stmt_execute($query);
    


?>
