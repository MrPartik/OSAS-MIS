<?php
	
    include('../../config/connection.php');     

    $appcode = $_GET['_appcode'];


    $view_query = mysqli_query($con,"SELECT  SUM(OrgRemittance_AMOUNT) AS AMOUNT,DATE_FORMAT(OrgRemittance_DATE_ADD, '%M') AS DATE FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE  = '$appcode' GROUP BY DATE_FORMAT(OrgRemittance_DATE_ADD, '%M') ORDER BY OrgRemittance_DATE_ADD ASC ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        $amount = $row["AMOUNT"];
        $date = $row["DATE"];
        
        $arr = array('amount' => $amount, 'date' => $date);
      array_push(  $container_arr, (array)$arr );

        
    }


    echo json_encode( $container_arr );


    
?>
