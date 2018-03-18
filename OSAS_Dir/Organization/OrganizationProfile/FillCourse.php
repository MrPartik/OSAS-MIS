<?php

    include('../../../config/connection.php');
    $id = $_GET['_appcode'];


    $view_query = mysqli_query($con,"SELECT AssOrgAcademic_COURSE_CODE as COURSE FROM `t_assign_org_academic_course`  INNER JOIN r_courses ON Course_CODE = AssOrgAcademic_COURSE_CODE
                where AssOrgAcademic_ORG_CODE = '$id' AND AssOrgAcademic_DISPLAY_STAT = 'Active' AND Course_DISPLAY_STAT = 'Active' ") ;
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $course = $row["COURSE"];
        
       $arr = array(
            'course' => $course
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }

     echo json_encode($container_arr);


        
?>
