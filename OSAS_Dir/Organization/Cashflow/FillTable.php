<?php
	
    include('../../../config/connection.php');     
    $compcode = $_GET['_code'];
    $query = "SELECT OrgCashFlowStatement_ID ID,OrgCashFlowStatement_ORG_CODE ORGCODE, IF(OrgCashFlowStatement_COLLECTION IS NULL,
    CONCAT('Voucher Item/s: ',(SELECT GROUP_CONCAT(OrgVouchItems_ITEM_NAME SEPARATOR ', ')
    FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO=OrgCashFlowStatement_ITEM
    GROUP BY OrgVouchItems_VOUCHER_NO)),
    CONCAT('Remit Description: ',(SELECT OrgRemittance_DESC FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM ))) AS DESCRIPTION,
    OrgCashFlowStatement_ITEM AS REF ,
    
IF(OrgCashFlowStatement_COLLECTION IS NOT NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_COLLECTION,3)),'') AS COLLECTION
,IF(OrgCashFlowStatement_EXPENSES IS NOT NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_EXPENSES,3)),'') AS EXPENSES
,CONCAT('₱',FORMAT(((@exsum := @exsum + IFNull( OrgCashFlowStatement_EXPENSES,0))),3)) AS exBal
,CONCAT('₱',FORMAT(((@colsum := @colsum + IFNull( OrgCashFlowStatement_COLLECTION,0))),3)) AS colBal
,CONCAT('₱',FORMAT(((@balsum := @colsum - @exsum)),3)) AS BALANCE
    ,OrgCashFlowStatement_REMARKS AS REMARKS,DATE_FORMAT(OrgCashFlowStatement_DATE_ADD,'%M %d, %Y') AS DATEISSUED FROM `t_org_cash_flow_statement`
    
cross join
(select @exsum := 0,@colsum := 0,@balsum := 0) params
    INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
    WHERE OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$compcode' ORDER BY OrgCashFlowStatement_ID asc ";
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
        $id = $row["ID"];
        $OrgCode = $row["ORGCODE"];
       $arr = array(
            'desc'  => $desc,
            'ref'  => $ref,
            'col'  => $col,
            'exp'  => $exp,
            'bal'  => $bal,
            'rem'  => $rem,
            'dat' => $dat,
            'id' => $id,
            'orgCode' =>$OrgCode
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
