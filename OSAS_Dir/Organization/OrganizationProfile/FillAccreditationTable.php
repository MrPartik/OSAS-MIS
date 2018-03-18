<?php

    include('../../../config/connection.php');
    $id = $_GET['_appcode'];
    $reqcode = $_GET['_reqcode'];




    $view_query = mysqli_query($con,"SELECT OrgAccrProcess_IS_ACCREDITED as STAT FROM `t_org_accreditation_process` where OrgAccrProcess_ORG_CODE = '$id' AND OrgAccrProcess_OrgAccrDetail_CODE = '$reqcode' ") ;
    $container_arr = array();
    $stat = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $stat = $row["STAT"]; 
        
    }

     echo $stat;


        
?>
