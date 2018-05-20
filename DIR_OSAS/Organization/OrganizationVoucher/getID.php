<?php
    include('../../../config/connection.php');     

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{

        $item = $_GET['item'];
        $query = mysqli_prepare($con, "SELECT OrgVoucher_ID FROM `t_org_voucher` WHERE OrgVoucher_CASH_VOUCHER_NO = ? ");
        mysqli_stmt_bind_param($query, 's', $item);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['OrgVoucher_ID'];

        }


        echo $id;   

        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
