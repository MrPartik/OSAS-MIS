<?php
	
    include('../../../config/connection.php');     
    $compcode = $_GET['_code'];
    $query = "SELECT OrgOffiPosDetails_NAME,OrgOffiPosDetails_DESC  FROM r_org_officer_position_details WHERE OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = '$compcode' ";
    $view_query = mysqli_query($con,$query);
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $pos = $row["OrgOffiPosDetails_NAME"];
        $desc = $row["OrgOffiPosDetails_DESC"];

       $arr = array(
            'pos'  => $pos,
            'desc' => $desc
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
