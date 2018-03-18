<?php
	
    include('../../config/connection.php');     

    $compcode = $_GET['_code'];

    $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,' ,',Stud_FNAME ,' ',IFNULL(Stud_MNAME,' ')) AS NAME , Stud_NO FROM `r_stud_profile` WHERE Stud_DISPLAY_STATUS = 'Active' AND Stud_NO NOT IN ((SELECT AssOrgMem_STUD_NO  FROM t_assign_org_members WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND AssOrgMem_APPL_ORG_CODE = '$compcode')) ");
    $list = ' <option value="default" selected disabled>Choose Student...</option>';
    while($row = mysqli_fetch_assoc($view_query))
    {
        $name = $row['NAME'];
        $no = $row['Stud_NO'];
        $list = $list . " <option value='$no' >$name</option>";
        
    }

   
    echo $list;

?>
