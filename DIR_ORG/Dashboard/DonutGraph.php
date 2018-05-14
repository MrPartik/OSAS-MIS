<?php
	
    include('../../config/connection.php');     

    $appcode = $_GET['_appcode'];


    $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU, Stud_COURSE AS COURSE,CONCAT('At ',COUNT(*)/(SELECT COUNT(*) FROM t_assign_org_members B
	INNER JOIN r_stud_profile ON B.AssOrgMem_STUD_NO = Stud_NO
    WHERE B.AssOrgMem_COMPL_ORG_CODE = '$appcode'  )*100,'% of population') AS PERCENTAGE FROM t_assign_org_members A
	INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
    WHERE AssOrgMem_COMPL_ORG_CODE = '$appcode' AND AssOrgMem_DISPLAY_STAT = 'Active' GROUP BY Stud_COURSE ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];
        $course = $row["COURSE"];
        $percent = $row["PERCENTAGE"];
        
        $arr = array('value'  => $cou, 'label' => $course, 'formatted' => $percent);
      array_push(  $container_arr, (array)$arr );

        
    }


    echo json_encode( $container_arr );


    
?>
