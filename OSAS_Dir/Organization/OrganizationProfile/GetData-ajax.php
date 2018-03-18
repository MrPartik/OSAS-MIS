<?php
include('../../../config/connection.php');
    $id = $_GET['_id'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $view_query = mysqli_query($con,"SELECT OAF.OrgAppProfile_APPL_CODE AS APPCODE,OAF.OrgAppProfile_NAME  AS APPNAME,OAF.OrgAppProfile_DESCRIPTION AS APPDESC ,OAF.OrgAppProfile_STATUS AS APPSTAT FROM r_org_applicant_profile  as OAF
    WHERE OAF.OrgAppProfile_APPL_CODE = (SELECT OrgForCompliance_OrgApplProfile_APPL_CODE FROM  t_org_for_compliance WHERE OrgForCompliance_ORG_CODE = '$id')");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $code = $row["APPCODE"];
        $name = $row['APPNAME'];
        $desc = $row['APPDESC'];
        $accstat = $row['APPSTAT'];
        

    }

    echo json_encode(
          array("code" => $code, 
          "name" => $name,"desc" => $desc, 
          "accstat" => $accstat)
     );


?>
