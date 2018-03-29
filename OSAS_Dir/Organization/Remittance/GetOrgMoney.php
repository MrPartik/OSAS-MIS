<?php
	
    include('../../../config/connection.php');     

    $id = $_GET['_id'];

    $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$id' ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $amount = $row["AMOUNT"];
    }
    echo json_encode(
          array("amount" => $amount)
     );


?>
