<?php
	
    include('../../config/connection.php');     
    $compcode = $_GET['_appcode'];
    
    $view_query = mysqli_query($con,"SELECT OrgRemittance_ID,OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT  ,OrgRemittance_DESC,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M %d, %Y') AS DATE  FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE  = '$compcode' ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        
        $amount = $row["AMOUNT"];
        $arr = array('amount' => $amount);
        array_push(  $container_arr, (array)$arr );
        
    }


    echo json_encode( $container_arr );


    
?>
