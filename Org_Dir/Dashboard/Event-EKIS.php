<?php
	
    include('../../config/connection.php');     
//    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
//	{
        session_start();
        $username = $_SESSION['logged_user']['username'];
        $container_arr = array();
        $view_query = mysqli_query($con,"SELECT DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%Y') AS CATEGORY FROM `t_org_for_compliance` AS E 
		INNER JOIN r_org_applicant_profile AS R ON R.OrgAppProfile_APPL_CODE = E.OrgForCompliance_OrgApplProfile_APPL_CODE
        INNER JOIN r_org_event_management AS I ON OrgEvent_OrgCode IN (OrgForCompliance_ORG_CODE)
		WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance WHERE OrgForCompliance_ORG_CODE = '$username') AND OrgEvent_STATUS = 'Approved' AND OrgEvent_DISPLAY_STAT = 'Active' GROUP BY DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%Y') ");
        $category_array = array();
        $arr = array();
        $finalarr = array();
        while($row = mysqli_fetch_assoc($view_query)){
            $cat = $row["CATEGORY"];
            array_push(  $category_array, $cat );

        }
           
        
        $finalarr = array( 'category' => $category_array);
        array_push(  $container_arr, $finalarr );

        echo json_encode( $container_arr );
        
//    }
//    else
//    {
//        
//        include('../../Retrict.php');
//        
//    }
//

    
?>
