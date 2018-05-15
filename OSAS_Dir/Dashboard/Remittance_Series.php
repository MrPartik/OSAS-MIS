<?php

    include('../../config/connection.php');


    $view_query = mysqli_query($con,"SELECT Batch_YEAR,sum(OrgRemittance_AMOUNT) AS AMO, OrgForCompliance_ORG_CODE FROM `r_batch_details`
                                            INNER JOIN t_org_for_compliance ON Batch_YEAR = OrgForCompliance_BATCH_YEAR
                                            INNER JOIN t_org_remittance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                            INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                            WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Approved' AND Batch_DISPLAY_STAT = 'Active' GROUP BY Batch_YEAR");
    $container_arr = array();


    while($row = mysqli_fetch_assoc($view_query))
    {
        $ser = $row["Batch_YEAR"];
        $data = $row["AMO"];
        $container_arr2 = array();
        $container_arr3 = array();


        $view_query2 = mysqli_query($con,"SELECT OrgAppProfile_NAME,OrgRemittance_ORG_CODE,OrgForCompliance_BATCH_YEAR,SUM(OrgRemittance_AMOUNT) AS AMO FROM `r_org_applicant_profile`
		INNER JOIN t_org_for_compliance ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
        INNER JOIN t_org_remittance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_batch_details ON Batch_YEAR = OrgForCompliance_BATCH_YEAR
		    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND  OrgRemittance_APPROVED_STATUS = 'Approved' AND OrgForCompliance_BATCH_YEAR = '$ser' GROUP BY OrgForCompliance_ORG_CODE ");
        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $vouch = $row2["OrgAppProfile_NAME"];
            $amount = $row2["AMO"];
            $code = $row2["OrgRemittance_ORG_CODE"];
//            $pdate = $row2["PDATE"];
//            $orgname = $row2["OrgVoucher_ORG_CODE"];

            $view_query3 = mysqli_query($con,"SELECT OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_NUMBER,OrgRemittance_AMOUNT FROM `t_org_remittance`
            INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgRemittance_ORG_CODE
            INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
            	WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Approved' AND OrgRemittance_ORG_CODE = '$code' ");
            while($row3 = mysqli_fetch_assoc($view_query3))
            {
                $vouchname = $row3["OrgAppProfile_NAME"];
                $sendby = $row3["OrgRemittance_SEND_BY"];
                $itemname = $row3["OrgRemittance_NUMBER"];
                $itemamount = $row3["OrgRemittance_AMOUNT"];
                $arr = array('itemname' => $itemname,'sendby' => $sendby,'vouchname' => $vouchname,'itemamount' => $itemamount);
                array_push(  $container_arr3, (array)$arr );


            }





            $arr = array('vouch' => $vouch,'amount' => $amount,'data2' => $container_arr3);
            array_push(  $container_arr2, (array)$arr );
            $container_arr3 = array();


        }
        $arr = array( 'name' => $ser, 'cat' => $data, "data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );



    }


    echo json_encode( $container_arr );



?>
