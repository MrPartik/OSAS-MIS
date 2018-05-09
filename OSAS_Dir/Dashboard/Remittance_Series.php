<?php
	
    include('../../config/connection.php');     


    $view_query = mysqli_query($con,"SELECT  FORMAT((sum(OrgRemittance_AMOUNT) / (SELECT SUM(OrgRemittance_AMOUNT) FROM `t_org_remittance`
INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' )) * 100,2)  AS PERCENT,sum(OrgRemittance_AMOUNT) as buo   ,  OrgAppProfile_NAME,OrgForCompliance_ORG_CODE  FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_APPROVED_STATUS = 'Approved' group by OrgForCompliance_ORG_CODE ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
//        $name = $row["OrgAppProfile_NAME"];
        $name = $row["OrgForCompliance_ORG_CODE"];
        $buo = $row["buo"];
        $orgcode = $row["OrgForCompliance_ORG_CODE"];
        $percent = $row["PERCENT"];
//        $amount = $row["AMOUNT"];
        $container_arr2 = array();
        
        
        $view_query2 = mysqli_query($con,"SELECT OrgRemittance_NUMBER,CONCAT('₱',FORMAT(OrgRemittance_AMOUNT,3)) AS AMOUNT,FORMAT((OrgRemittance_AMOUNT / ( SELECT SUM(OrgRemittance_AMOUNT)  FROM t_org_remittance
                                                INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE  = '$orgcode' ) ) * 100,3) AS PER,OrgRemittance_AMOUNT  FROM t_org_remittance
                                                INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE  = '$orgcode' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
        while($row2 = mysqli_fetch_assoc($view_query2))
        {
            $amount = $row2["OrgRemittance_NUMBER"];
            $pamount = $row2["OrgRemittance_AMOUNT"];
            //$amount = $row2["AMOUNT"];
            $per = $row2["PER"];
            $arr = array('text' => $amount,'pamount' => $pamount,'per' => $per);
            array_push(  $container_arr2, (array)$arr );


        }
        $arr = array( 'name' => $name,'buo' => $buo, 'orgcode' => $orgcode, 'percent' => $percent,"data" => $container_arr2);
        array_push(  $container_arr, (array)$arr );
        

        
    }


    echo json_encode( $container_arr );


    
?>
