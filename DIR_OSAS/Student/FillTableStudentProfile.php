<?php
	
    include('../../config/connection.php');     
    $CourseVal = $_GET['_CourseVal'];
    $YearVal = $_GET['_YearVal'];
    $SectionVal = $_GET['_SectionVal'];
    
    if($CourseVal == 'Default' && $YearVal == 'Default' && $SectionVal == 'Default')
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";        
    else if($CourseVal == 'Default'  && $YearVal == 'Default' && $SectionVal != 'Default')
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_SECTION = '$SectionVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";      
    else if($CourseVal == 'Default'  && $YearVal != 'Default' && $SectionVal != 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_SECTION = '$SectionVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";      
    else if($CourseVal != 'Default'  && $YearVal != 'Default' && $SectionVal != 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_SECTION = '$SectionVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";   
    else if($CourseVal != 'Default'  && $YearVal == 'Default' && $SectionVal == 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_COURSE = '$CourseVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";
    else if($CourseVal != 'Default'  && $YearVal != 'Default' && $SectionVal == 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_YEAR_LEVEL = '$YearVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";    
    else if($CourseVal == 'Default'  && $YearVal != 'Default' && $SectionVal == 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_YEAR_LEVEL = '$YearVal' GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";

    else if($CourseVal != 'Default'  && $YearVal == 'Default' && $SectionVal != 'Default'  )
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
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 WHERE RSP.Stud_COURSE = '$CourseVal' AND RSP.Stud_SECTION = '$SectionVal'  GROUP BY RSP.Stud_NO   ORDER BY ay.ActiveAcadYear_ID desc ";



    
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
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $id = $row["ID"];
        $studnum = $row["Stud_NO"];
        $name = $row["FullName"];
        $course = $row["Course"];
        $email = $row["Stud_EMAIL"];
        $num = $row["Stud_MOBILE_NO"];

       $arr = array(
            'id'  => $id,
            'studnum'  => $studnum,
            'name'  => $name,
            'course'  => $course,
            'email'  => $email,
            'num'  => $num
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
