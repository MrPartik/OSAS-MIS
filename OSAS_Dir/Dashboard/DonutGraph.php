<?php
	
    include('../../config/connection.php');     

    $view_query = mysqli_query($con,"SELECT  COUNT(*) AS COU,
    Stud_COURSE AS COURSE,

    CONCAT(
        'At ',
         FORMAT((
        SELECT
            COUNT(*)
        FROM
            r_stud_profile AS B
        WHERE
            B.Stud_COURSE = A.Stud_COURSE AND Stud_DISPLAY_STATUS = 'Active'
    )/(SELECT COUNT(*) FROM r_stud_profile AS B WHERE Stud_DISPLAY_STATUS = 'Active') * 100,3),'% of population'
    ) AS PER
FROM 
    r_stud_profile AS A WHERE Stud_DISPLAY_STATUS = 'Active' GROUP BY A.Stud_COURSE ");
    $container_arr = array();

    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];
        $course = $row["COURSE"];
        $percent = $row["PER"];
        
        $arr = array('value'  => $cou,  'label' => $course, 'formatted' => $percent);
      array_push(  $container_arr, (array)$arr );

        
    }


    echo json_encode( $container_arr );


    
?>
