<?php
	
    include('../config/connection.php');     

    $appcode = $_POST['_appcode'];


    $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU, Stud_COURSE AS COURSE FROM t_assign_org_members 
	INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
    WHERE AssOrgMem_APPL_ORG_CODE = '$appcode' GROUP BY Stud_COURSE ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];
        $course = $row["COURSE"];

        
    }


    echo json_encode( array('cou'  => $cou, 'course' => $course));


    
?>
