<?php
	
	include('../../../config/connection.php'); 

 
    $id = $_GET['_id'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $view_query = mysqli_query($connection,"SELECT OAF.OrgAppProfile_APPL_CODE AS APPCODE,OAF.OrgAppProfile_NAME  AS APPNAME,OAF.OrgAppProfile_DESCRIPTION AS APPDESC ,OAF.OrgAppProfile_STATUS AS APPSTAT ,OFC.OrgForCompliance_ORG_CODE AS  COMPCODE,OFC.OrgForCompliance_ADVISER AS ADVISER,OFC.OrgForCompliance_BATCH_YEAR AS BATCHYEAR,AOC.AssOrgCategory_ORGCAT_CODE AS CATCODE,OC.OrgCat_NAME AS CATNAME,OS.OrgEssentials_MISSION AS ORGMIS,OS.OrgEssentials_VISION AS ORGVIS,(SELECT AOAC.AssOrgAcademic_COURSE_CODE FROM `t_assign_org_academic_course` AOAC WHERE AOAC.AssOrgAcademic_ORG_CODE =  OFC.OrgForCompliance_ORG_CODE) AS COUCODE FROM r_org_applicant_profile  as OAF
	INNER JOIN t_org_for_compliance as OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAF.OrgAppProfile_APPL_CODE
    INNER JOIN t_assign_org_category AS AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE
    INNER JOIN r_org_essentials AS OS ON OS.OrgEssentials_ORG_CODE = OFC.OrgForCompliance_ORG_CODE
    INNER JOIN r_org_category AS OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE
    WHERE OAF.OrgAppProfile_ID = $id");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $code = $row["APPCODE"];
        $name = $row['APPNAME'];
        $desc = $row['APPDESC'];
        $accstat = $row['APPSTAT'];
        $compcode = $row['COMPCODE'];
        $advname = $row['ADVISER'];
        $drpyear = $row['BATCHYEAR'];
        $drpcat = $row['CATCODE'];
        $mission = $row['ORGMIS'];
        $vision = $row['ORGVIS'];		
        $catcode = $row['CATCODE'];		
        $catname = $row['CATNAME'];	
        $coucode = $row['COUCODE'];	
        

    }

    $view_query = mysqli_query($connection,"SELECT OrgCat_CODE AS CODE,OrgCat_NAME AS NAME FROM `r_org_category` WHERE OrgCat_DISPLAY_STAT = 'Active' ");
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $fillcode = $row["CODE"];
        $fillname = $row['NAME'];
        if($fillcode == $catcode)
            $selcat = $selcat . '<option value="'.$fillcode.'" selected>'.$fillname.'</option>';
        else
            $selcat = $selcat . '<option value="'.$fillcode.'" >'.$fillname.'</option>';            


    }


    $view_query = mysqli_query($connection,"SELECT Course_CODE as CODE FROM `r_courses` WHERE Course_DISPLAY_STAT = 'Active'");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $curcode = $row["CODE"];

        if($coucode == $curcode)
            $selcou = $selcou . '<option value="'.$curcode.'" selected>'.$curcode.'</option>';
        else
            $selcou = $selcou . '<option value="'.$curcode.'" >'.$curcode.'</option>';            

    }	
    if($catname == 'Academic Organization')
        $selstat = '1';
    else   
        $selstat = '0';


    $view_query = mysqli_query($connection,"SELECT Batch_YEAR as YEAR FROM `r_batch_details` WHERE Batch_DISPLAY_STAT = 'Active' ");
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $fillyear = $row["YEAR"];
        if($fillyear == $drpyear)
            $selyear = $selyear . '<option value="'.$fillyear.'" selected>'.$fillyear.'</option>';
        else
            $selyear = $selyear . '<option value="'.$fillyear.'" >'.$fillyear.'</option>';            
      

    }

    $view_query = mysqli_query($connection,"SELECT OAD.OrgAccrDetail_CODE AS CODE, OAD.OrgAccrDetail_NAME AS NAME,(SELECT OAP.OrgAccrProcess_IS_ACCREDITED FROM `t_org_accreditation_process` AS OAP WHERE OAP.OrgAccrProcess_ORG_CODE = '$compcode' AND OAP.OrgAccrProcess_OrgAccrDetail_CODE = OAD.OrgAccrDetail_CODE )  AS STATUS FROM `r_org_accreditation_details` AS OAD WHERE OAD.OrgAccrDetail_DISPLAY_STAT = 'Active'");
    $i = 1;
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $curstat = $row["STATUS"];
        $curcode = $row["CODE"];
        $curname = $row["NAME"];

        $tblstat = $tblstat .
        "<tr class=''>
            <td>$i</td>
            <td>$curname</td>";
        if($curstat == 1)
        {
            $tblstat = $tblstat . "<td><input type='checkbox' id='chkupdstat".$i."' name='chkupdacc' class='checkbox form-control' style='width: 20px' checked></td>";
        }
        else
            $tblstat = $tblstat . "<td><input type='checkbox' id='chkupdstat".$i."' name='chkupdacc' class='checkbox form-control' style='width: 20px' ></td>";
            
        $tblstat = $tblstat .
            "<td id='updcode".$i."' class='hidden'>".$curcode."</td>
        </tr>";

        $i = $i + 1;
    }


    



    echo json_encode(
          array("code" => $code, 
          "name" => $name,"desc" => $desc, 
          "accstat" => $accstat,"compcode" => $compcode, 
          "advname" => $advname,"drpyear" => $drpyear, 
          "drpcat" => $drpcat,"mission" => $mission,"catcode" => $catcode,"catname" => $catname,"fillcat" => $selcat, "fillyear" => $selyear,"fillacc" => $tblstat,"fillcou" => $selcou,"getstat" => $selstat, 
          "vision" => $vision)
     );

?>
