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

    $curstep = 1;
    $view_query = mysqli_query($con," SELECT WIZARD_CURRENT_STEP AS CURSTEP FROM `r_application_wizard` WHERE WIZARD_ORG_CODE =  '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $curstep = $row["CURSTEP"];
    }
    
    echo $curstep;


?>
