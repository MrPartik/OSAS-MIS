<?php
include('../../../config/connection.php');
    $id = $_GET['_id'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $view_query = mysqli_query($con,"SELECT OAF.OrgAppProfile_APPL_CODE AS APPCODE,OAF.OrgAppProfile_NAME  AS APPNAME,OAF.OrgAppProfile_DESCRIPTION AS APPDESC ,OAF.OrgAppProfile_STATUS AS APPSTAT FROM r_org_applicant_profile  as OAF
    WHERE OAF.OrgAppProfile_APPL_CODE = '$id' ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $code = $row["APPCODE"];
        $name = $row['APPNAME'];
        $desc = $row['APPDESC'];
        $accstat = $row['APPSTAT'];
        

    }

    $view_query = mysqli_query($con,"SELECT AssOrgCategory_ORGCAT_CODE,OrgCat_NAME FROM `t_assign_org_category` 
		INNER JOIN r_org_category ON AssOrgCategory_ORGCAT_CODE = OrgCat_CODE
        WHERE AssOrgCategory_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$id' LIMIT 1) ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $catcode = $row["AssOrgCategory_ORGCAT_CODE"];
        $catname = $row['OrgCat_NAME'];

    }
 

    echo json_encode(
          array("code" => $code, 
          "name" => $name,"desc" => $desc, 
          "accstat" => $accstat,"catcode" => $catcode,"catname" => $catname)
     );


?>
