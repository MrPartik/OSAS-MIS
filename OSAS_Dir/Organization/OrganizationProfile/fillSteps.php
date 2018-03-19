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
    $year='';
    $catname='';
    $catcode='';
    $advname='';
    
    $view_query = mysqli_query($con,"SELECT OrgForCompliance_BATCH_YEAR AS BATYEAR
        FROM t_org_for_compliance WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $year = $row["BATYEAR"];

    }
    
    $view_query1 = mysqli_query($con,"SELECT OrgCat_NAME AS CATNAME,AssOrgCategory_ORGCAT_CODE AS CATCODE
            FROM t_org_for_compliance 
		INNER JOIN t_assign_org_category ON AssOrgCategory_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_org_category ON OrgCat_CODE = AssOrgCategory_ORGCAT_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$id'") ;
    while($row = mysqli_fetch_assoc($view_query1))
    {
        $catname = $row["CATNAME"];
        $catcode = $row["CATCODE"];
        
    }
    $view_query2 = mysqli_query($con,"SELECT OrgForCompliance_ADVISER AS ADVNAME
    FROM t_org_for_compliance WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query2))
    {
    $advname = $row["ADVNAME"];

    }

    $view_query3 = mysqli_query($con,"SELECT OrgEssentials_MISSION AS MISSION, OrgEssentials_VISION AS VISION FROM r_org_essentials WHERE OrgEssentials_ORG_CODE ='$id' ") ;
    while($row = mysqli_fetch_assoc($view_query3))
    {
        $mission = $row["MISSION"];
        $vision = $row["VISION"]; 
    }



    $view_querycourse = mysqli_query($con,"SELECT AssOrgAcademic_COURSE_CODE as COURSE FROM `t_assign_org_academic_course`  INNER JOIN r_courses ON Course_CODE = AssOrgAcademic_COURSE_CODE
                where AssOrgAcademic_ORG_CODE = '$id' AND AssOrgAcademic_DISPLAY_STAT = 'Active' AND Course_DISPLAY_STAT = 'Active' ") ;
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_querycourse))
    {
        $course = $row["COURSE"];
        
       $arr = array( 'course' => $course );
       array_push($container_arr, (array)$arr );
        
        
    }

    echo json_encode(
          array("year" => $year,"catname" => $catname,"catcode" => $catcode,"advname" => $advname,"mission" => $mission,"vision" => $vision,$container_arr)
     );


?>
