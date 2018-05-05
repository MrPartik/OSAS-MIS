<?php
    include('../../../config/connection.php');
	if( isset($_POST['_code'])  && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        session_start();
        $id = $_SESSION['logged_user']['username'];
		$code = $_POST['_code'];
		
        $query = mysqli_prepare($con, "UPDATE t_org_remittance SET OrgRemittance_REC_BY = ?,OrgRemittance_APPROVED_STATUS = 'Approved',OrgRemittance_DATE_MOD = CURRENT_TIMESTAMP  WHERE  OrgRemittance_NUMBER =  ?");
        mysqli_stmt_bind_param($query, 'ss', $id, $code);
        mysqli_stmt_execute($query);
        $id = 'Received By: '. $id;
        $query = mysqli_prepare($con, "INSERT INTO t_org_cash_flow_statement (OrgCashFlowStatement_ORG_CODE,OrgCashFlowStatement_ITEM,OrgCashFlowStatement_REMARKS) VALUES ((SELECT OrgRemittance_ORG_CODE FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = ?),?,?)");
        mysqli_stmt_bind_param($query, 'sss', $code, $code,$id);
        mysqli_stmt_execute($query);

        
	}
    else
    {
        
        include('../../../Retrict.php');
        
    }
   


?>
