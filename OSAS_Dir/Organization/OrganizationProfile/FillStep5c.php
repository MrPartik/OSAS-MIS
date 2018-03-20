<?php
    include('../../../config/connection.php');
    $compcode = $_GET['_code'];

    $container_arr = array();

    $view_query = mysqli_query($con,"SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,IF(Stud_MNAME = '','',CONCAT(' ',Stud_MNAME)))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS,OrgOffiPosDetails_NAME AS POS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        INNER JOIN t_org_officers  ON OrgOffi_STUD_NO = AssOrgMem_STUD_NO       
        INNER JOIN r_org_officer_position_details ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
        WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND  OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND  AssOrgMem_COMPL_ORG_CODE = '$compcode' AND OrgOffiPosDetails_ORG_CODE =  '$compcode'");
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $i++;
        $name = $row["NAME"];
        $pos = $row["POS"];
        $arr = array('name' => $name,'pos' => $pos );
        array_push(  $container_arr, (array)$arr );


    }
        



    echo json_encode($container_arr);


?>
