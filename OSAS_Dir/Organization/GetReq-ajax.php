<?php
	
	include('../../connection.php');
    
    $codelist = array();
    $j = 1;

    $view_query = mysqli_query($connection,"SELECT OrgAccrDetail_CODE as CODE FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
    while($row = mysqli_fetch_array($view_query))
    {   
        $codelist = $row['CODE'];
        $j++;

    }
 
    echo json_encode(
          array("count" => $j)
     );

?>
