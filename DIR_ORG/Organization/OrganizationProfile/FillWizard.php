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

    $curstep = 1;
    $view_query = mysqli_query($con," SELECT WIZARD_CURRENT_STEP AS CURSTEP FROM `r_application_wizard` WHERE WIZARD_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$id') ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $curstep = $row["CURSTEP"];
    }
    
    $view_query = mysqli_query($con,"SELECT OrgForCompliance_BATCH_YEAR AS BATYEAR,OrgCat_NAME AS CATNAME,AssOrgCategory_ORGCAT_CODE AS CATCODE,OrgForCompliance_ADVISER AS ADVNAME
    
            FROM t_org_for_compliance 
		INNER JOIN t_assign_org_category ON AssOrgCategory_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_org_category ON OrgCat_CODE = AssOrgCategory_ORGCAT_CODE
                                            WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$id' ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $year = $row["BATYEAR"];
        $catname = $row["CATNAME"];
        $catcode = $row["CATCODE"];
        $advname = $row["ADVNAME"];
        

    }
   
    $view_query = mysqli_query($con,"SELECT OrgEssentials_MISSION AS MISSION, OrgEssentials_VISION AS VISION FROM r_org_essentials 
                                            WHERE OrgEssentials_ORG_CODE = (SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_DISPAY_STAT = 'Active' AND OrgForCompliance_OrgApplProfile_APPL_CODE = '$id') ") ;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $mission = $row["MISSION"];
        $vision = $row["VISION"];


    }


    

    echo json_encode(
          array("year" => $year,"catname" => $catname,"catcode" => $catcode,"advname" => $advname,"mission" => $mission,"vision" => $vision,"curstep" => $curstep)
     );


?>
