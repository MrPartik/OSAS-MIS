<?php
	
	include('../../connection.php');
    $compcode = $_GET['_code'];


    $view_query = mysqli_query($connection," SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'  ");
    $prog = 'q';
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $countlist = $row["COU"];

    }

    $view_query = mysqli_query($connection," SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = '$compcode' AND OrgAccrProcess_DISPLAY_STAT = 'Active'");
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $count = $row["COU"];

    }
    $list = '';
    if($count == '0')
    {
        
        $view_query = mysqli_query($connection,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
        $i = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $i++;
            $desc = $row["des"];
            $code = $row["code"];
            $list = $list .  "
            <tr class=''>
                <td id='code$i' class='hidden'>$code</td>
                <td>$i</td>
                <td >$desc</td>
                <td><input type='checkbox' id='chkstat$i' name='chkacc' class='checkbox form-control' disabled style='width: 20px'></td>

            </tr>
                    ";
        }			
        
    }
    else
    {
     
        $view_query = mysqli_query($connection," SELECT COUNT(*) AS COU FROM t_org_accreditation_process WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_ORG_CODE = '$compcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count2 = $row["COU"];

        }
        
        $view_query = mysqli_query($connection,"SELECT OrgAccrDetail_DESC as des,OrgAccrProcess_OrgAccrDetail_CODE as code,OrgAccrProcess_IS_ACCREDITED AS STAT FROM `t_org_accreditation_process` INNER JOIN r_org_accreditation_details ON OrgAccrDetail_CODE = OrgAccrProcess_OrgAccrDetail_CODE WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' AND OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_ORG_CODE = '$compcode' ");
        $i = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $i++;
            $desc = $row["des"];
            $code = $row["code"];
            $stat = $row["STAT"];
            $show = '';
            if($stat == '1')
                $show = 'checked';
            else
                $show = '';
            
            $list = $list .  "
            <tr class=''>
                <td id='code$i' class='hidden'>$code</td>
                <td>$i</td>
                <td >$desc</td>
                <td><input type='checkbox' id='chkstat$i' name='chkacc' $show class='checkbox form-control' disabled style='width: 20px'></td>

            </tr>
                    ";
        }		
        
        
        
    }
    $view_query = mysqli_query($connection,"SELECT DISTINCT 

            OrgAccrProcess_ORG_CODE AS CODE ,OrgAppProfile_NAME AS NAME,
            (SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = OrgForCompliance_ORG_CODE AND 									OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_IS_ACCREDITED = '1')
            /
            (SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active')  * 100  PROGRESS    ,
            IF(
                (SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active') = 
                (SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = OrgForCompliance_ORG_CODE AND 									OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_IS_ACCREDITED = '1') ,
                'Accredited','Running for accreditation') AS STAT 
                FROM t_org_accreditation_process 
                INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgAccrProcess_ORG_CODE 
                INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE 
                WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgForCompliance_DISPAY_STAT = 'Active' AND OrgAppProfile_DISPLAY_STAT = 'Active' AND OrgAccrProcess_ORG_CODE = '$compcode' ");
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $prog = $row["PROGRESS"];
    }		



    echo json_encode(
          array("count" => $count,"list" => $list,"countlist" => $countlist,"prgbar" => $prog)
     );

?>
