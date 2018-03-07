<?php
	
	include('../../connection.php');

 
    $id = $_GET['_id'];
    $selcat = '';
    $selcou = '';
    $selyear = '';
    $selstat = 0;
    $tblstat = '';
    $view_query = mysqli_query($connection,"SELECT *,(SELECT AOAC.AssOrgAcademic_COURSE_CODE FROM `t_assign_org_academic_course` AOAC WHERE AOAC.AssOrgAcademic_ORG_CODE = OFC.OrgForCompliance_ORG_CODE) AS COUCODE,AOC.AssOrgCategory_ORGCAT_CODE AS CATCODE,OC.OrgCat_NAME AS CATNAME,OS.OrgEssentials_MISSION AS ORGMIS,OS.OrgEssentials_VISION AS ORGVIS FROM `t_org_for_compliance` AS OFC INNER JOIN t_assign_org_category AS AOC ON AOC.AssOrgCategory_ORG_CODE = OFC.OrgForCompliance_ORG_CODE INNER JOIN r_org_category AS OC ON OC.OrgCat_CODE = AOC.AssOrgCategory_ORGCAT_CODE INNER JOIN r_org_essentials AS OS ON OS.OrgEssentials_ORG_CODE = OFC.OrgForCompliance_ORG_CODE WHERE OFC.OrgForCompliance_ORG_CODE = '$id'");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $compcode = $row["OrgForCompliance_ORG_CODE"];
        $code = $row['OrgForCompliance_OrgApplProfile_APPL_CODE'];
        $adv = $row['OrgForCompliance_ADVISER'];
        $year = $row['OrgForCompliance_BATCH_YEAR'];
        $coucode = $row['COUCODE'];
        $catcode = $row['CATCODE'];		
        $catname = $row['CATNAME'];	
        $vis = $row['ORGVIS'];	
        $mis = $row['ORGMIS'];	

        

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
        if($fillyear == $year)
            $selyear = $selyear . '<option value="'.$fillyear.'" selected>'.$fillyear.'</option>';
        else
            $selyear = $selyear . '<option value="'.$fillyear.'" >'.$fillyear.'</option>';            
      

    }


    echo json_encode(
          array("year" => $selyear,"adv" => $adv,"setstat" => $selstat,"selcat" => $selcat,"selcou" => $selcou,"vis" => $vis,"mis" => $mis)
     );

?>
