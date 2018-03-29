<?php
	
    include('../../../config/connection.php');     
    $compcode = $_GET['_code'];
    $query = "SELECT IF(OrgCashFlowStatement_COLLECTION IS NULL,'A',
        (SELECT OrgRemittance_DESC FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM )) 		 AS DESCRIPTION,IF(OrgCashFlowStatement_COLLECTION IS NULL,'A',
        (SELECT OrgCashFlowStatement_ITEM FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM ))   AS REF ,IF(OrgCashFlowStatement_COLLECTION IS NOT 
                                                                                                             	             NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_COLLECTION,3)),'') AS COLLECTION,IF(OrgCashFlowStatement_EXPENSES IS NOT 
                                                                                                             	             NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_EXPENSES,3)),'') AS EXPENSES,
       		CONCAT('₱',FORMAT((SELECT IFNULL(SUM(OrgRemittance_AMOUNT),0) FROM t_org_remittance WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgRemittance_DATE_ADD <= OrgCashFlowStatement_DATE_ADD) - (SELECT IFNULL(SUM(OrgVouchItems_AMOUNT),0) FROM `t_org_voucher_items` 
	INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
    WHERE OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgVouchItems_DATE_ADD <= OrgCashFlowStatement_DATE_ADD AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active' ),3)) AS BALANCE,OrgCashFlowStatement_REMARKS AS REMARKS,DATE_FORMAT(OrgCashFlowStatement_DATE_ADD,'%M %d, %Y') AS DATEISSUED                                                                                                                     
        FROM `t_org_cash_flow_statement`
		INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
        WHERE OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$compcode' ORDER BY OrgCashFlowStatement_DATE_ADD DESC ";
    $view_query = mysqli_query($con,$query);
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $desc = $row["DESCRIPTION"];
        $ref = $row["REF"];
        $col = $row["COLLECTION"];
        $exp = $row["EXPENSES"];
        $bal = $row["BALANCE"];
        $rem = $row["REMARKS"];
        $dat = $row["DATEISSUED"];

       $arr = array(
            'desc'  => $desc,
            'ref'  => $ref,
            'col'  => $col,
            'exp'  => $exp,
            'bal'  => $bal,
            'rem'  => $rem,
            'dat' => $dat
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
