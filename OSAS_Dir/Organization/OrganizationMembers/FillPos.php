<?php
	
    include('../../../config/connection.php');

    $compcode = $_GET['_code'];

    $view_query = mysqli_query($con," SELECT OrgOffiPosDetails_ID,OrgOffiPosDetails_NAME FROM `r_org_officer_position_details`
		WHERE OrgOffiPosDetails_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$compcode' AND OrgForCompliance_DISPAY_STAT = 'Active') AND OrgOffiPosDetails_DISPLAY_STAT = 'Active'  ");
    $list = ' <option selected value="member" >Member</option>';
    while($row = mysqli_fetch_assoc($view_query))
    {
        $id = $row['OrgOffiPosDetails_ID'];
        $name = $row['OrgOffiPosDetails_NAME'];
        $list = $list . " <option value='".$id."' >".$name."</option>";
        
    }

   
    echo json_encode(
          array("list" => $list)
     );

?>
