<?php
	
    include('../../config/connection.php');     


    $view_query = mysqli_query($con,"SELECT DATE_FORMAT(OrgVoucher_DATE_ADD,'%Y') AS CAT,(SELECT SUM(OrgVouchItems_AMOUNT) FROM `t_org_voucher` AS E
		INNER JOIN t_org_voucher_items AS R ON R.OrgVouchItems_VOUCHER_NO = E.OrgVoucher_CASH_VOUCHER_NO
        WHERE DATE_FORMAT(E.OrgVoucher_DATE_ADD,'%Y') = DATE_FORMAT(I.OrgVoucher_DATE_ADD,'%Y')
        GROUP BY DATE_FORMAT(OrgVoucher_DATE_ADD,'%Y')) AS DATAS 
		FROM `t_org_voucher` AS I WHERE OrgVoucher_DISPLAY_STAT = 'Active'
        GROUP BY DATE_FORMAT(OrgVoucher_DATE_ADD,'%Y')");
    $container_arr = array();
    session_start();
    $username = $_SESSION['logged_user']['username'];


    while($row = mysqli_fetch_assoc($view_query))
    {
        $ser = $row["CAT"];
        $data = $row["DATAS"];
        $container_arr2 = array();
        $container_arr3 = array();
        
        
        $view_query2 = mysqli_query($con,"SELECT DATE_FORMAT(OrgVoucher_DATE_ADD,'%Y') as PDATE,OrgVoucher_CASH_VOUCHER_NO,SUM(OrgVouchItems_AMOUNT) AS AMO FROM `t_org_voucher` AS E
		INNER JOIN t_org_voucher_items AS R ON R.OrgVouchItems_VOUCHER_NO = E.OrgVoucher_CASH_VOUCHER_NO
        WHERE DATE_FORMAT(OrgVoucher_DATE_ADD,'%Y') = '$ser' GROUP BY OrgVouchItems_VOUCHER_NO ");
        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $vouch = $row2["OrgVoucher_CASH_VOUCHER_NO"];
            $amount = $row2["AMO"];
            $pdate = $row2["PDATE"];
            
            $view_query3 = mysqli_query($con,"SELECT '$vouch' as VNUM,OrgVouchItems_ITEM_NAME,OrgVouchItems_AMOUNT FROM `t_org_voucher_items` WHERE OrgVouchItems_VOUCHER_NO = '$vouch' ");
            while($row3 = mysqli_fetch_assoc($view_query3))
            {
                $vouchname = $row3["VNUM"];
                $itemname = $row3["OrgVouchItems_ITEM_NAME"];
                $itemamount = $row3["OrgVouchItems_AMOUNT"];
                $arr = array('itemname' => $itemname,'vouchname' => $vouchname,'itemamount' => $itemamount);
                array_push(  $container_arr3, (array)$arr );


            }
            
            
            
            
            
            $arr = array('vouch' => $vouch,'pdate' => $pdate,'amount' => $amount,'data2' => $container_arr3);
            array_push(  $container_arr2, (array)$arr );
            $container_arr3 = array();


        }
        $arr = array( 'name' => $ser, 'cat' => $data, "data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );
        

        
    }


    echo json_encode( $container_arr );


    
?>
