<?php
    include('../../../config/connection.php');
    $compcode = $_GET['_code'];
    $query = "SELECT OrgOffiPosDetails_NAME AS NAME,OrgOffiPosDetails_DESC AS DESCR,OrgOffiPosDetails_NumOfOcc AS OCC FROM `r_org_officer_position_details` WHERE OrgOffiPosDetails_ORG_CODE = '$compcode' and OrgOffiPosDetails_DISPLAY_STAT = 'Active'";

    $view_query = mysqli_query($con,$query);
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $NAME = $row["NAME"];
        $DESCR = $row["DESCR"];
        $OCC = $row["OCC"];

        $arr = array(
            'name'  => $NAME,
            'desc'  => $DESCR,
            'occ'  => $OCC
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);


    ?>
