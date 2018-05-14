<?php
	
include('../../../config/connection.php');     
    $compcode = $_GET['_code'];
    $query = "SELECT COUNT(*) AS COU  FROM r_org_officer_position_details WHERE OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = '$compcode' ";
    $view_query = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];
        
    }


    echo json_encode( array('cou'  => $cou));
?>
