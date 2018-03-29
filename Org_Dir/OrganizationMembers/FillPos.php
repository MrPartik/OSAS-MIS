<?php
    include('../../config/connection.php');
    $compcode = $_GET['_code'];
    


    $view_query = mysqli_query($con," SELECT OrgOffiPosDetails_ID,OrgOffiPosDetails_NAME FROM `r_org_officer_position_details` WHERE OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND (SELECT COUNT(*) FROM `t_org_officers` WHERE OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID ) < OrgOffiPosDetails_NumOfOcc AND OrgOffiPosDetails_ORG_CODE = '$compcode'  ");
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
