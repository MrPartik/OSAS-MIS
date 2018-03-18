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
    
    $view_query = mysqli_query($con,"SELECT OrgForCompliance_ADVISER AS ADVNAME
            FROM t_org_for_compliance WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $advname = $row["ADVNAME"];
        
    }
   


    echo json_encode(
          array("advname" => $advname)
     );


?>
