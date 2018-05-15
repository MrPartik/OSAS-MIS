<?php
	
    include('../../../config/connection.php');     

    $compcode = $_GET['_code'];
    $query = "SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS, IFNULL((SELECT OrgOffiPosDetails_NAME FROM r_org_officer_position_details 
		INNER JOIN t_org_officers ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
 	WHERE OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffi_STUD_NO = Stud_NO  AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = '$compcode'   ),'Member') AS POS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        LEFT JOIN t_org_officers  ON OrgOffi_STUD_NO = AssOrgMem_STUD_NO       
        LEFT JOIN r_org_officer_position_details ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
        WHERE AssOrgMem_DISPLAY_STAT = 'Active'  AND AssOrgMem_COMPL_ORG_CODE = '$compcode' GROUP BY Stud_NO";
    $view_query = mysqli_query($con,$query);
    $container_arr = array();
    while($row = mysqli_fetch_assoc($view_query))
    {
        $snum = $row["Stud_NO"];
        $sname = $row["NAME"];
        $cas = $row["CAS"];
        $pos = $row["POS"];

       $arr = array(
            'name'  => $sname,
            'pos'  => $pos,
            'cas'  => $cas,
            'num' => $snum
              );
      array_push(  $container_arr, (array)$arr );
        
        
    }


    echo json_encode($container_arr);
?>
