<?php
    include('../../../config/connection.php');
    $id = $_GET['_appcode'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $mission = '';
    $vision = '';
    
    $view_query = mysqli_query($con,"SELECT OrgEssentials_MISSION AS MISSION, OrgEssentials_VISION AS VISION FROM r_org_essentials WHERE OrgEssentials_ORG_CODE = '$id'") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $mission = $row["MISSION"];
        $vision = $row["VISION"];


    }

   


    echo json_encode(
          array("mission" => $mission,"vision" => $vision)
     );


?>
