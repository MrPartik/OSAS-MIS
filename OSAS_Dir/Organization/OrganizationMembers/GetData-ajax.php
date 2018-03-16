<?php
	
    include('../../../config/connection.php');

    $compcode = $_GET['_code'];
    $stat = $_GET['_stat'];
    

    $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND AssOrgMem_APPL_ORG_CODE = '$compcode' ");

// $view_query = mysqli_query($connection," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ', Stud_MNAME) AS NAME , Stud_NO,OrgForCompliance_OrgApplProfile_APPL_CODE FROM `r_stud_profile` 
//		INNER JOIN t_assign_org_academic_course ON AssOrgAcademic_COURSE_CODE = Stud_COURSE
//		INNER JOIN t_org_for_compliance ON AssOrgAcademic_ORG_CODE = 					OrgForCompliance_ORG_CODE
//		INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
//    
//    		WHERE Stud_DISPLAY_STATUS = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_APPL_CODE = '$compcode' ");
    $list = '';
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $i++;
        $no = $row["Stud_NO"];
        $name = $row["NAME"];

        if($stat == '1')
        {
            
            $list = $list .  "
        
            <tr class=''>
                <td >$no</td>
                <td >$name</td>
            </tr>
                ";

        }            
        else
        {
            
            $list = $list .  "
        
            <tr class=''>
                <td >$no</td>
                <td >$name</td>
                <td><center><a class='btn btn-danger delete tooltips' data-toggle='tooltip' href='javascript:;'><i class='fa fa-trash-o' ></i></a></center></td>
            </tr>
                    ";
            
        }
        
        
        
    }

    if($i == 0)
        $list = $list. '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';

     echo json_encode(
          array("list" => $list,"getcountlist" => $i)
     );
?>
