<?php
	
	include('../../connection.php');

    $studno = $_GET['_studno'];
    $appcode = $_GET['_appcode'];
    
    $view_query = mysqli_query($connection,"SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        WHERE AssOrgMem_STUD_NO = '$studno' AND AssOrgMem_APPL_ORG_CODE = '$appcode'");

    while($row = mysqli_fetch_assoc($view_query))
    {
        $snum = $row["Stud_NO"];
        $sname = $row["NAME"];
        $cas = $row["CAS"];
    }

     echo json_encode(
          array("snum" => $snum,"sname" => $sname, "cas" => $cas)
     );

		
    
    
?>
