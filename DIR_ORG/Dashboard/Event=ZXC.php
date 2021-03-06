<?php
	
    include('../../config/connection.php');     


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
    session_start();
    $username = $_SESSION['logged_user']['username'];


    while($row = mysqli_fetch_assoc($view_query))
    {
        $ser = $row["Batch_YEAR"];
        $data = $row["AMO"];
        $container_arr2 = array();
        $container_arr3 = array();
        $container_arr4 = array();
        
        
        $view_query2 = mysqli_query($con,"SELECT OrgAppProfile_NAME,OrgForCompliance_ORG_CODE,SUM(OrgVouchItems_AMOUNT) AS AMO,OrgForCompliance_BATCH_YEAR FROM `t_org_voucher`AS TB1
		INNER JOIN t_org_for_compliance as TB2 ON OrgForCompliance_ORG_CODE = OrgVoucher_ORG_CODE
        INNER JOIN r_org_applicant_profile AS TB3 ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
        INNER JOIN r_batch_details AS TB4 ON Batch_YEAR = OrgForCompliance_BATCH_YEAR
        INNER JOIN t_org_voucher_items AS TB5 ON OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO
        WHERE Batch_YEAR = '$ser' AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND Batch_DISPLAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$username'
        GROUP BY OrgForCompliance_ORG_CODE");
        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $vouch = $row2["OrgForCompliance_ORG_CODE"];
            $amount = $row2["AMO"];
//            $pdate = $row2["PDATE"];
            $orgname = $row2["OrgAppProfile_NAME"];
            
            $view_query3 = mysqli_query($con,"SELECT OrgVouchItems_VOUCHER_NO,OrgVoucher_ORG_CODE,SUM(OrgVouchItems_AMOUNT) AS AMO FROM `t_org_voucher`AS TB1
        INNER JOIN t_org_voucher_items AS TB2 ON OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO
        WHERE OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVoucher_ORG_CODE = '$vouch' GROUP BY OrgVouchItems_VOUCHER_NO ");
            while($row3 = mysqli_fetch_assoc($view_query3))
            {
                $vouchname = $row3["OrgVoucher_ORG_CODE"];
                $itemname = $row3["OrgVouchItems_VOUCHER_NO"];
                $itemamount = $row3["AMO"];
                
                $view_query4 = mysqli_query($con,"SELECT OrgVouchItems_VOUCHER_NO,OrgVouchItems_ITEM_NAME,OrgVouchItems_AMOUNT FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = '$itemname' ");
                while($row4 = mysqli_fetch_assoc($view_query4))
                {
                    $layer4id = $row4["OrgVouchItems_VOUCHER_NO"];
                    $layer4name = $row4["OrgVouchItems_ITEM_NAME"];
                    $layer4y = $row4["OrgVouchItems_AMOUNT"];
                    $arr = array('layer4id' => $layer4id,'layer4name' => $layer4name,'layer4y' => $layer4y);
                    array_push(  $container_arr4, (array)$arr );
                    
                }
                

                $arr = array('itemname' => $itemname,'vouchname' => $vouchname,'itemamount' => $itemamount,'data3' => $container_arr4);
                array_push(  $container_arr3, (array)$arr );
                $container_arr4 = array();


            }
            
            
            
            
            
            $arr = array('orgname' => $orgname,'vouch' => $vouch,'amount' => $amount,'data2' => $container_arr3);
//            $arr = array('orgname' => $orgname,'vouch' => $vouch,'pdate' => $pdate,'amount' => $amount,'data2' => $container_arr3);
            array_push(  $container_arr2, (array)$arr );
            $container_arr3 = array();


        }
        $arr = array( 'name' => $ser, 'cat' => $data, "data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );
        

        
    }


    echo json_encode( $container_arr );


    
?>
