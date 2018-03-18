<?php
	
	include('../../connection.php');
    $compcode = $_GET['_code'];

    $view_query = mysqli_query($connection," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ', Stud_MNAME) AS NAME , Stud_NO,OrgForCompliance_OrgApplProfile_APPL_CODE FROM `r_stud_profile` 
		INNER JOIN t_assign_org_academic_course ON AssOrgAcademic_COURSE_CODE = Stud_COURSE
		INNER JOIN t_org_for_compliance ON AssOrgAcademic_ORG_CODE = 					OrgForCompliance_ORG_CODE
		INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
    
    		WHERE Stud_DISPLAY_STATUS = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE = '$compcode' ");
    $list = '';
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $i++;
        $no = $row["Stud_NO"];
        $code = $row["OrgForCompliance_OrgApplProfile_APPL_CODE"];

        $getcount = mysqli_query($connection," SELECT COUNT(*) AS COU FROM t_assign_org_members WHERE AssOrgMem_STUD_NO = '$no' ");
        while($row2 = mysqli_fetch_assoc($getcount))
        {
            $cou = $row2["COU"];
        }
        
        if($cou == '1')            
            $query = mysqli_query($connection,"UPDATE t_assign_org_members SET AssOrgMem_COMPL_ORG_CODE = '$code' WHERE AssOrgMem_STUD_NO = '$no' ");
        else        
            $query = mysqli_query($connection,"INSERT INTO t_assign_org_members (AssOrgMem_STUD_NO,AssOrgMem_COMPL_ORG_CODE) VALUES ('$no','$code') ");

    }

   
    echo json_encode(
          array("list" => $list)
     );

?>
