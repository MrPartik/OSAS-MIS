<?php 

include('../../../config/connection.php');

 
    $stat = $_GET['_stat'];
    $ref = $_GET['_ref'];
    $container_arr = array();

    if($stat == 'org')
    {
        
        $view_query = mysqli_query($con," SELECT OrgForCompliance_ORG_CODE AS COMPCODE,concat(OrgForCompliance_ORG_CODE,'-',OrgAppProfile_NAME) AS NAME FROM t_org_for_compliance
		INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
       WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE NOT IN (SELECT Users_REFERENCED FROM `r_users` WHERE Users_REFERENCED NOT IN ( '$ref','')) ");
        while($row = mysqli_fetch_assoc($view_query))
        {
            $val = $row["COMPCODE"];
            $text = $row['NAME'];
            $arr = array('val'  => $val,'text'  => $text);
            array_push(  $container_arr, (array)$arr );


        }
        
    }
    else if($stat == 'stud')
    {
        
        $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME, ' , ' , Stud_FNAME , ' ' ,Stud_MNAME) AS NAME, Stud_NO AS NO FROM `r_stud_profile`
			WHERE Stud_DISPLAY_STATUS = 'Active' AND Stud_NO NOT IN (SELECT Users_REFERENCED FROM `r_users` WHERE Users_REFERENCED NOT IN ( '$ref','')) ORDER BY  CONCAT(Stud_LNAME, ' , ' , Stud_FNAME , ' ' ,Stud_MNAME)   ");
        while($row = mysqli_fetch_assoc($view_query))
        {
            $val = $row["NO"];
            $text = $row['NAME'];

            $arr = array('val'  => $val,'text'  => $text);
            array_push(  $container_arr, (array)$arr );


        }
        
    }
    else if($stat == 'osas')
    {
        
        $view_query = mysqli_query($con," SELECT OSASHead_CODE AS CODE , OSASHead_NAME AS NAME FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active' AND OSASHead_CODE NOT IN (SELECT Users_REFERENCED FROM `r_users` WHERE Users_REFERENCED NOT IN ( '$ref','')) ");
        while($row = mysqli_fetch_assoc($view_query))
        {
            $val = $row["CODE"];
            $text = $row['NAME'];

            $arr = array('val'  => $val,'text'  => $text);
            array_push(  $container_arr, (array)$arr );


        }
        
    }

    echo json_encode($container_arr);

?>
