<?php
	
    include('../../../config/connection.php');     

    $id = $_GET['_id'];
    $amount ='₱ 0.000';

    $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$id' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
    
<<<<<<< HEAD
//    $view_query = mysqli_query($con,"select (@exsum := @exsum + IFNull( OrgCashFlowStatement_EXPENSES,0)) as exSum
//    ,(@colsum := @colsum + IFNull( OrgCashFlowStatement_COLLECTION,0)) as colSum
//    ,CONCAT('₱ ',FORMAT(((@balsum := @colsum - @exsum)),3)) AS AMOUNT
//    from t_org_cash_flow_statement
//    cross join 
//    (select @exsum := 0,@colsum := 0,@balsum := 0) params
//    where OrgCashFlowStatement_ORG_CODE ='$id' AND OrgRemittance_APPROVED_STATUS = 'Approved'
//    order by OrgCashFlowStatement_ID asc ");
=======
    $view_query = mysqli_query($con,"select (@exsum := @exsum + IFNull( OrgCashFlowStatement_EXPENSES,0)) as exSum
    ,(@colsum := @colsum + IFNull( OrgCashFlowStatement_COLLECTION,0)) as colSum
    ,FORMAT(((@balsum := @colsum - @exsum)),3) AS AMOUNT
    from t_org_cash_flow_statement
    cross join 
    (select @exsum := 0,@colsum := 0,@balsum := 0) params
    where OrgCashFlowStatement_ORG_CODE ='$id'
    order by OrgCashFlowStatement_ID asc ");
>>>>>>> fc785fbfa6b379886e4618e53c388cd9d35f7747
    while($row = mysqli_fetch_assoc($view_query))
    {
        $amount = $row["AMOUNT"];
    }
    echo json_encode(
          array("amount" => $amount)
     );


?>
