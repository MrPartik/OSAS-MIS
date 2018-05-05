<?php
	
    include('../../config/connection.php');     

    $id = $_GET['_id'];

    $view_query = mysqli_query($con," SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,OrgEvent_PROPOSED_DATE AS PROPDATE,OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE 
                                                    WHERE OrgEvent_Code  = '$id' ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $name = $row["OrgEvent_NAME"];
        $desc = $row["OrgEvent_DESCRIPTION"];
        $date = $row["PROPDATE"];

    }
    echo json_encode(
          array("name" => $name,"desc" => $desc,"date" => $date)
     );


?>
