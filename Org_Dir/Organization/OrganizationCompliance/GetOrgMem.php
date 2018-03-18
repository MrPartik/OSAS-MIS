<?php
	
	include('../../../config/connection.php');
    $compcode = $_GET['_code'];
    $query = "SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO , CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND AssOrgMem_APPL_ORG_CODE = (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance WHERE OrgForCompliance_ORG_CODE = '$compcode') ";
    $view_query = mysqli_query($con,$query);
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $snum = $row["Stud_NO"];
        $sname = $row["NAME"];
        $cas = $row["CAS"];

       $arr = array(
            'name'  => $sname,
            'cas'  => $cas,
            'num' => $snum
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
