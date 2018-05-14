<?php
    include('../../../config/connection.php');
    $compcode = $_GET['_code'];
    
    $view_query = mysqli_query($con,"SELECT OrgCat_NAME FROM `t_assign_org_category` 
	INNER JOIN r_org_category ON AssOrgCategory_ORGCAT_CODE = OrgCat_CODE
    WHERE AssOrgCategory_ORG_CODE = '$compcode'") ;
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        $category = $row["OrgCat_NAME"];
    }

    $view_query = mysqli_query($con," SELECT OrgOffiPosDetails_ID,OrgOffiPosDetails_NAME FROM `r_org_officer_position_details` WHERE OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND (SELECT COUNT(*) FROM `t_org_officers` WHERE OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID ) < OrgOffiPosDetails_NumOfOcc AND OrgOffiPosDetails_ORG_CODE = '$compcode' ");
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $i++;
        $id = $row["OrgOffiPosDetails_ID"];
        $name = $row["OrgOffiPosDetails_NAME"];
        $arr = array('name' => $name,'id' => $id );
        array_push(  $container_arr, (array)$arr );


    }
        



    echo json_encode($container_arr);


?>
