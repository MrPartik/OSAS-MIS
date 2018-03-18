<?php
    include('../../../config/connection.php');
    $id = $_GET['_appcode'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $mission = '';
    $vision = '';
    
    $view_query = mysqli_query($con,"SELECT OrgCat_NAME AS CATNAME,AssOrgCategory_ORGCAT_CODE AS CATCODE
            FROM t_org_for_compliance 
		INNER JOIN t_assign_org_category ON AssOrgCategory_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_org_category ON OrgCat_CODE = AssOrgCategory_ORGCAT_CODE WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_ORG_CODE = '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $catname = $row["CATNAME"];
        $catcode = $row["CATCODE"];
        
    }
   


    echo json_encode(
          array("catname" => $catname,"catcode" => $catcode)
     );


?>
