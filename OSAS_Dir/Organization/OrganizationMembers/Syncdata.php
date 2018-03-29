<?php
	
    include('../../../config/connection.php');     

    $compcode = $_GET['_code'];
//    $query = mysqli_query($connection,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Inactive' WHERE AssOrgMem_COMPL_ORG_CODE = '$compcode' ");
    $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ', IFNULL(Stud_MNAME,'')) AS NAME , Stud_NO FROM `r_stud_profile` 
    		WHERE Stud_DISPLAY_STATUS = 'Active' AND Stud_COURSE IN ( SELECT AssOrgAcademic_COURSE_CODE FROM `t_assign_org_academic_course` WHERE AssOrgAcademic_DISPLAY_STAT= 'Active' AND AssOrgAcademic_ORG_CODE = '$compcode')");
    $list = '';
    $i = 0;

    while($row = mysqli_fetch_assoc($view_query))
    {
        $i++;
        $no = $row["Stud_NO"];

          

        $getcount = mysqli_query($con," SELECT COUNT(*) AS COU FROM t_assign_org_members WHERE AssOrgMem_STUD_NO = '$no' AND AssOrgMem_COMPL_ORG_CODE = '$compcode' ");
        while($row2 = mysqli_fetch_assoc($getcount))
        {
            $cou = $row2["COU"];
        }
        
        if($cou == '1')
//            break;
            $query = mysqli_query($con,"UPDATE t_assign_org_members SET AssOrgMem_DISPLAY_STAT = 'Active' WHERE AssOrgMem_STUD_NO = '$no' and AssOrgMem_COMPL_ORG_CODE = '$compcode' ");
        else        
            $query = mysqli_query($con,"INSERT INTO t_assign_org_members (AssOrgMem_STUD_NO,AssOrgMem_COMPL_ORG_CODE) VALUES ('$no','$compcode') ");

    }

   
    echo json_encode(
          array("list" => $list)
     );


?>
