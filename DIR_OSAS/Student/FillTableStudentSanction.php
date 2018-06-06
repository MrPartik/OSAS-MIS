<?php
	
    include('../../config/connection.php');     
    $CourseVal = $_GET['_CourseVal'];
    $YearVal = $_GET['_YearVal'];
    $SectionVal = $_GET['_SectionVal'];
    $NotCleared = $_GET['_NotClearedFilter'];
    $Cleared = $_GET['_ClearedFilter'];

    $query = "select RSP.Stud_ID as ID
                                ,RSP.Stud_NO ,CONCAT(RSP.Stud_LNAME,', ',RSP.Stud_FNAME,' ',COALESCE(RSP.Stud_MNAME,'')) as FullName
                                ,CONCAT(RSP.Stud_COURSE,' ',RSP.Stud_YEAR_LEVEL,'-',RSP.Stud_SECTION) as Course
                                ,RSP.Stud_EMAIL
                                ,RSP.Stud_MOBILE_NO
                                ,RSP.Stud_GENDER
                                ,RSP.Stud_BIRTH_DATE
                                ,RSP.Stud_BIRTH_PLACE
                                ,RSP.Stud_STATUS
                                ,RSP.Stud_CITY_ADDRESS
                                ,RSP.Stud_DATE_ADD,(SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = RSP.Stud_NO and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') AS S1, (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE= b.SancDetails_CODE WHERE a.AssSancStudStudent_STUD_NO  = RSP.Stud_NO and a.AssSancStudStudent_IS_FINISH ='finished' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive' ) AS S2,(SELECT max(DATE_FORMAT(AssSancStudStudent_DATE_MOD, '%M %d, %Y %l:%i %p ') ) from t_assign_stud_saction where AssSancStudStudent_STUD_NO = RSP.Stud_NO) AS DATE
                                    FROM osas.r_stud_profile RSP
                                    INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                    INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                    AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE 1 = 1 ";

    if($CourseVal == 'Default' && $YearVal == 'Default' && $SectionVal == 'Default')
        $addquery = '';

    else if($CourseVal == 'Default'  && $YearVal == 'Default' && $SectionVal != 'Default')
        $addquery = " AND RSP.Stud_SECTION = '$SectionVal'";

    else if($CourseVal == 'Default'  && $YearVal != 'Default' && $SectionVal != 'Default'  )
        $addquery = " AND RSP.Stud_SECTION = '$SectionVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal'";
  
    else if($CourseVal != 'Default'  && $YearVal != 'Default' && $SectionVal != 'Default'  )
         $addquery = " AND RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_SECTION = '$SectionVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal'";

    else if($CourseVal != 'Default'  && $YearVal == 'Default' && $SectionVal == 'Default'  )
        $addquery = " AND RSP.Stud_COURSE = '$CourseVal'";

    else if($CourseVal != 'Default'  && $YearVal != 'Default' && $SectionVal == 'Default'  )
        $addquery = " AND RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal'";

    else if($CourseVal == 'Default'  && $YearVal != 'Default' && $SectionVal == 'Default'  )
        $addquery = " AND RSP.Stud_YEAR_LEVEL = '$YearVal'";

    else if($CourseVal != 'Default'  && $YearVal == 'Default' && $SectionVal != 'Default'  )
        $addquery = " AND RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_SECTION = '$SectionVal'";

    if($NotCleared != 'false' && $Cleared  != 'false' )
        $addquery = $addquery . "";
    else if($NotCleared != 'false' && $Cleared  == 'false' )
        $addquery = $addquery . " AND (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = RSP.Stud_NO and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') > 0";    
    else if($NotCleared == 'false' && $Cleared  != 'false' )
        $addquery = $addquery . " AND (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = RSP.Stud_NO and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') = 0";    
    else if($NotCleared == 'false' && $Cleared  == 'false' )
        $addquery = $addquery . " AND (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = RSP.Stud_NO and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') = 0 AND (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = RSP.Stud_NO and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') > 0";

    $query = $query . $addquery .        " GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";        

    
//    $query = "select RSP.Stud_ID as ID
//                                    ,RSP.Stud_NO ,CONCAT(RSP.Stud_LNAME,', ',RSP.Stud_FNAME,' ',COALESCE(RSP.Stud_MNAME,'')) as FullName
//                                    ,CONCAT(RSP.Stud_COURSE,' ',RSP.Stud_YEAR_LEVEL,'-',RSP.Stud_SECTION) as Course
//                                    ,RSP.Stud_EMAIL
//                                    ,RSP.Stud_MOBILE_NO
//                                    ,RSP.Stud_GENDER
//                                    ,RSP.Stud_BIRTH_DATE
//                                    ,RSP.Stud_BIRTH_PLACE
//                                    ,RSP.Stud_STATUS
//                                    ,RSP.Stud_CITY_ADDRESS
//                                    ,RSP.Stud_DATE_ADD
//                                        FROM osas.r_stud_profile RSP
//                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
//                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
//                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal' AND RSP.Stud_SECTION = '$SectionVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";
    $view_query = mysqli_query($con,$query);
//    echo $NotCleared . ' - ' .$Cleared ;
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $id = $row["ID"];
        $studnum = $row["Stud_NO"];
        $name = $row["FullName"];
        $course = $row["Course"];
        $email = $row["Stud_EMAIL"];
        $num = $row["Stud_MOBILE_NO"];
        $s1 = $row["S1"];
        $s2 = $row["S2"];

       $arr = array(
            'id'  => $id,
            'studnum'  => $studnum,
            'name'  => $name,
            'course'  => $course,
            'email'  => $email,
            's1'  => $s1,
            's2'  => $s2,
            'num'  => $num
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
