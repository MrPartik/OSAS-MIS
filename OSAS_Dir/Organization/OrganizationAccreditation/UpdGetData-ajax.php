<?php
	
	include('../../../config/connection.php');
    $compcode = $_GET['_code'];


    $view_query = mysqli_query($con," SELECT COUNT(*) AS COU FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'  ");
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $countlist = $row["COU"];

    }

    $view_query = mysqli_query($con," SELECT COUNT(*) AS COU FROM `t_org_accreditation_process` WHERE OrgAccrProcess_ORG_CODE = '$compcode' AND OrgAccrProcess_DISPLAY_STAT = 'Active'");
    while($row = mysqli_fetch_assoc($view_query))
    {   
        $count = $row["COU"];

    }
    $list = '';
    if($count == '0')
    {
        
        $view_query = mysqli_query($con,"SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' ");
        $i = 0;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $i++;
            $desc = $row["des"];
            $code = $row["code"];
            $list = $list .  "
            <tr class=''>
                <td id='updcode$i' class='hidden'>$code</td>
                <td>$i</td>
                <td >$desc</td>
                <td><input type='checkbox' id='chkstat$i' name='chkupdacc' class='checkbox form-control' style='width: 20px'></td>

            </tr>
                    ";
        }			
        
    }
    else
    {
     
        $view_query = mysqli_query($con," SELECT COUNT(*) AS COU FROM t_org_accreditation_process WHERE OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_ORG_CODE = '$compcode' ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $count2 = $row["COU"];

        }
        
        $view_query = mysqli_query($con,"
        SELECT OrgAccrDetail_DESC as des,OrgAccrDetail_CODE as code,IFNULL((SELECT OrgAccrProcess_IS_ACCREDITED FROM `t_org_accreditation_process` WHERE OrgAccrDetail_CODE = OrgAccrProcess_OrgAccrDetail_CODE AND OrgAccrProcess_ORG_CODE = '$compcode' ),0) AS STAT  FROM `r_org_accreditation_details` WHERE OrgAccrDetail_DISPLAY_STAT = 'Active'
        ");
//                SELECT OrgAccrDetail_DESC as des,OrgAccrProcess_OrgAccrDetail_CODE as code,OrgAccrProcess_IS_ACCREDITED AS STAT FROM `t_org_accreditation_process` INNER JOIN r_org_accreditation_details ON OrgAccrDetail_CODE = OrgAccrProcess_OrgAccrDetail_CODE WHERE OrgAccrDetail_DISPLAY_STAT = 'Active' AND OrgAccrProcess_DISPLAY_STAT = 'Active' AND OrgAccrProcess_ORG_CODE = '$compcode' 
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
                <td id='updcode$i' class='hidden'>$code</td>
                <td>$i</td>
                <td >$desc</td>
                <td><input type='checkbox' id='chkupdstat$i' name='chkupdacc' $show class='checkbox form-control' style='width: 20px'></td>

            </tr>
                    ";
        }		
        
        
        
    }

    echo json_encode(
          array("count" => $count,"list" => $list,"countlist" => $countlist)
     );

?>
