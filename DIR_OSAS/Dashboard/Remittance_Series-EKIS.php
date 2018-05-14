<?php
	
    include('../../config/connection.php');     


//    $view_query = mysqli_query($con,"SELECT  FORMAT((sum(OrgRemittance_AMOUNT) / (SELECT SUM(OrgRemittance_AMOUNT) FROM `t_org_remittance`
//INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
//INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
//WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' )) * 100,2)  AS PERCENT,sum(OrgRemittance_AMOUNT) as buo   ,  OrgAppProfile_NAME,OrgForCompliance_ORG_CODE  FROM t_org_remittance
//                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
//                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
//                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Approved'
//                                                    AND OrgForCompliance_BATCH_YEAR = 
//                                                    group by OrgForCompliance_ORG_CODE ");

    $view_query = mysqli_query($con,"SELECT Batch_YEAR,sum(OrgRemittance_AMOUNT) AS AMO, OrgForCompliance_ORG_CODE FROM `r_batch_details` 
                                            INNER JOIN t_org_for_compliance ON Batch_YEAR = OrgForCompliance_BATCH_YEAR
                                            INNER JOIN t_org_remittance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                            INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                            WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Approved' AND Batch_DISPLAY_STAT = 'Active' GROUP BY Batch_YEAR ");

$container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
//        $name = $row["OrgAppProfile_NAME"];
        $name = $row["Batch_YEAR"];
        $buo = $row["AMO"];
        $orgcode = $row["OrgForCompliance_ORG_CODE"];
//        $percent = $row["PERCENT"];
//        $amount = $row["AMOUNT"];
        $container_arr2 = array();
        
        
        $view_query2 = mysqli_query($con,"SELECT OrgAppProfile_NAME,OrgForCompliance_BATCH_YEAR,SUM(OrgRemittance_AMOUNT) AS AM FROM `r_org_applicant_profile`
		INNER JOIN t_org_for_compliance ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
        INNER JOIN t_org_remittance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_batch_details ON Batch_YEAR = OrgForCompliance_BATCH_YEAR
		    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND  OrgRemittance_APPROVED_STATUS = 'Approved' GROUP BY OrgForCompliance_ORG_CODE ");

        
        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $amount = $row2["OrgAppProfile_NAME"];
            $pamount = $row2["AM"];
            //$amount = $row2["AMOUNT"];
//            $per = $row2["PER"];
            $arr = array('text' => $amount,'pamount' => $pamount);
//            $arr = array('text' => $amount,'pamount' => $pamount,'per' => $per);
            array_push(  $container_arr2, (array)$arr );


        }
//        $arr = array( 'name' => $name,'buo' => $buo, 'orgcode' => $orgcode, 'percent' => $percent,"data" => $container_arr2);
        $arr = array( 'name' => $name,'buo' => $buo, 'orgcode' => $orgcode, "data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );
        

        
    }


    echo json_encode( $container_arr );


    
?>
