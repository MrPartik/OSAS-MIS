<?php
    include('../../../config/connection.php');
    $compcode = $_GET['_code'];
    
    $view_query = mysqli_query($con,"SELECT OrgCat_NAME FROM `t_assign_org_category` 
	INNER JOIN r_org_category ON AssOrgCategory_ORGCAT_CODE = OrgCat_CODE
    WHERE AssOrgCategory_ORG_CODE = '$compcode'") ;
    $container_arr = array();
    $category = '';
    while($row = mysqli_fetch_assoc($view_query))
    {
        $category = $row["OrgCat_NAME"];
    }

    if($category == 'Academic Organization')
    {
        
        $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ', IFNULL(Stud_MNAME,'')) AS NAME , Stud_NO FROM `r_stud_profile` 
        WHERE Stud_DISPLAY_STATUS = 'Active' AND Stud_COURSE IN ( SELECT AssOrgAcademic_COURSE_CODE FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT= 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode') AND Stud_NO NOT IN (SELECT OrgOffi_STUD_NO FROM t_org_officers
	INNER JOIN r_org_officer_position_details ON OrgOffi_OrgOffiPosDetails_ID = OrgOffiPosDetails_ID
    WHERE OrgOffiPosDetails_ORG_CODE = '$compcode' AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffi_DISPLAY_STAT = 'Active' 
 )");
        $i = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $i++;
            $no = $row["Stud_NO"];
            $name = $row["NAME"];
            $arr = array('name' => $name,'no' => $no );
            array_push(  $container_arr, (array)$arr );



            $getcount = mysqli_query($con," SELECT COUNT(*) AS COU FROM t_assign_org_members WHERE AssOrgMem_STUD_NO = '$no' AND AssOrgMem_COMPL_ORG_CODE = '$compcode' ");
            while($row2 = mysqli_fetch_assoc($getcount))
            {
                $cou = $row2["COU"];
            }

            if($cou == '1')
                $query = mysqli_query($con,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Active' WHERE AssOrgMem_STUD_NO = '$no' and AssOrgMem_COMPL_ORG_CODE = '$compcode' ");
            else        
                $query = mysqli_query($con,"INSERT INTO t_assign_org_members (AssOrgMem_STUD_NO,AssOrgMem_COMPL_ORG_CODE) VALUES ('$no','$compcode') ");


            
        }
        
    }
    else
    {

        $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ', IFNULL(Stud_MNAME,'')) AS NAME , Stud_NO FROM `r_stud_profile` 
        WHERE Stud_DISPLAY_STATUS = 'Active' ");
        $i = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $i++;
            $no = $row["Stud_NO"];
            $name = $row["NAME"];
            $arr = array('name' => $name,'no' => $no );
            array_push(  $container_arr, (array)$arr );


            
        }
        
    }


    echo json_encode($container_arr);


?>
