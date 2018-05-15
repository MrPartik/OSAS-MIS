<?php

    include('../../config/connection.php');


    session_start();
    $username = $_SESSION['logged_user']['username'];
    $view_query = mysqli_query($con,"SELECT K.Batch_YEAR,IFNULL((SELECT SUM(OrgVouchItems_AMOUNT) FROM `t_org_voucher` AS E
		INNER JOIN t_org_voucher_items AS R ON R.OrgVouchItems_VOUCHER_NO = E.OrgVoucher_CASH_VOUCHER_NO
       	INNER JOIN t_org_for_compliance AS I ON I.OrgForCompliance_ORG_CODE = E.OrgVoucher_ORG_CODE
 		INNER JOIN r_batch_details AS C ON C.Batch_YEAR = I.OrgForCompliance_BATCH_YEAR
 			WHERE C.Batch_YEAR = K.Batch_YEAR AND I.OrgForCompliance_ORG_CODE = '$username'
 			GROUP BY C.Batch_YEAR),0) AS AMO FROM `r_batch_details` AS K
        	WHERE K.Batch_DISPLAY_STAT = 'Active' AND K.Batch_YEAR IN ((SELECT C.Batch_YEAR FROM `t_org_voucher` AS V
		INNER JOIN t_org_voucher_items AS A ON A.OrgVouchItems_VOUCHER_NO = V.OrgVoucher_CASH_VOUCHER_NO
       	INNER JOIN t_org_for_compliance AS L ON L.OrgForCompliance_ORG_CODE = V.OrgVoucher_ORG_CODE
 		INNER JOIN r_batch_details AS C ON C.Batch_YEAR = L.OrgForCompliance_BATCH_YEAR
 			WHERE  L.OrgForCompliance_ORG_CODE = '$username'
 			GROUP BY C.Batch_YEAR))");
    $container_arr = array();


    while($row = mysqli_fetch_assoc($view_query))
    {
        $ser = $row["Batch_YEAR"];
        $data = $row["AMO"];
        $container_arr2 = array();
        $container_arr3 = array();


            $view_query2 = mysqli_query($con,"SELECT OrgVouchItems_VOUCHER_NO,OrgVoucher_ORG_CODE,SUM(OrgVouchItems_AMOUNT) AS AMO FROM `t_org_voucher`AS TB1
        INNER JOIN t_org_voucher_items AS TB2 ON OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO
        WHERE OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVoucher_ORG_CODE = '$username' GROUP BY OrgVouchItems_VOUCHER_NO ");

        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $vouchname = $row2["OrgVoucher_ORG_CODE"];
            $itemname = $row2["OrgVouchItems_VOUCHER_NO"];
            $itemamount = $row2["AMO"];
//            $pdate = $row2["PDATE"];

            $view_query3 = mysqli_query($con,"SELECT OrgVouchItems_VOUCHER_NO,OrgVouchItems_ITEM_NAME,OrgVouchItems_AMOUNT FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = '$itemname' ");
            while($row3 = mysqli_fetch_assoc($view_query3))
            {
                $vouchname = $row3["OrgVouchItems_VOUCHER_NO"];
                $itemname = $row3["OrgVouchItems_ITEM_NAME"];
                $itemamount2 = $row3["OrgVouchItems_AMOUNT"];
                $arr = array('itemname' => $itemname,'vouchname' => $vouchname,'itemamount' => $itemamount2);
                array_push(  $container_arr3, (array)$arr );


            }





            $arr = array('vouch' => $vouchname,'amount' => $itemamount,'data2' => $container_arr3);
            array_push(  $container_arr2, (array)$arr );
            $container_arr3 = array();


        }
        $arr = array( 'name' => $ser, 'cat' => $data, "data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );



    }


    echo json_encode( $container_arr );



?>
