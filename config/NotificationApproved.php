<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $item = $_POST['item'];
        session_start();
        $id = $_SESSION['logged_user']['username'];
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, " UPDATE t_org_remittance SET OrgRemittance_APPROVED_STATUS = 'Approved',OrgRemittance_REC_BY = '$id' WHERE OrgRemittance_NUMBER = ? ");
            mysqli_stmt_bind_param($query, 's', $item);
            mysqli_stmt_execute($query);
            
            $id = 'Received By: '. $id;

            $query = mysqli_prepare($con, "INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_REMARKS) VALUES ((SELECT OrgRemittance_ORG_CODE FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = ?),?,?)");
            mysqli_stmt_bind_param($query, 'sss', $item, $item,$id);
            mysqli_stmt_execute($query);

        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
