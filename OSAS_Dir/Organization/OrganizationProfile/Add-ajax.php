<?php
	
include('../../../config/connection.php');     

	if(isset($_POST['_name']))
	{
		
        $year = '2017';
        $firyear = '2017';    
        $view_query = mysqli_query($con,"SELECT * FROM  active_academic_year where `ActiveAcadYear_IS_ACTIVE` =1 and `ActiveAcadYear_ID` = (SELECT MAX(`ActiveAcadYear_ID`) FROM active_academic_year A 
        INNER JOIN r_batch_details B ON A.ActiveAcadYear_Batch_YEAR = B.Batch_YEAR AND B.Batch_DISPLAY_STAT='ACTIVE' WHERE A.ActiveAcadYear_IS_ACTIVE =1 ) ") ;        
        while($row = mysqli_fetch_assoc($view_query))
        {
            $year = $row["ActiveAcadYear_Batch_YEAR"];

        }
        $firyear = substr($year,0,4);

        
		$name = $_POST['_name'];
		$appcode = $_POST['_appcode'];
        
        $split = str_split($name);
        $acr = '';
        $flag = 0;
        foreach ($split as $data )
        {
            if($flag == 0)
            {        
                $acr = $acr . $data;
                $flag = 1;
            }
            else if($data == ' ')
            {
                $flag = 0;
            }

        }
        $acr = strtoupper($acr);
        $acr = $acr . $firyear;
        
        $query = mysqli_query($con,"INSERT INTO t_org_for_compliance (OrgForCompliance_ORG_CODE,OrgForCompliance_OrgApplProfile_APPL_CODE,OrgForCompliance_BATCH_YEAR)  VALUES ('$acr','$appcode','$year')");

        $query = mysqli_query($con,"INSERT INTO r_application_wizard (WIZARD_ORG_CODE,WIZARD_CURRENT_STEP) VALUES ('$acr',-1) ");
/*
        
        $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE FROM t_org_for_compliance INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE WHERE OrgAppProfile_APPL_CODE = '$appcode' ORDER BY OrgAppProfile_DATE_ADD DESC LIMIT 1") ;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $code = $row["WIZARD_ORG_CODE"];

            
        }

        $query = mysqli_query($con,"UPDATE r_application_wizard SET WIZARD_CURRENT_STEP = '-1'  WHERE WIZARD_ORG_CODE = '$code' ");
*/
                
	}

?>
