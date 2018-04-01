<?php
	
include('../../../config/connection.php');     

	if(isset($_POST['_name']))
	{
		
        $year = '';
        $firyear = '';    
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

        $AssignCode = mysqli_query($con,"SELECT IF
        (IFNULL((SELECT Acad.AssOrgAcademic_ORG_CODE FROM  t_assign_org_academic_course Acad WHERE Acad.AssOrgAcademic_ORG_CODE = (SELECT A.OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance A WHERE A.OrgForCompliance_ORG_CODE='$acr')),'NULL')='NULL',
        (SELECT B.AssOrgNonAcademic_NON_ACAD  FROM t_assign_org_non_academic B WHERE B.AssOrgNonAcademic_ORG_CODE = (SELECT A.OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance A WHERE A.OrgForCompliance_ORG_CODE='$acr' )),(SELECT B.AssOrgAcademic_COURSE_CODE  FROM t_assign_org_academic_course B WHERE B.AssOrgAcademic_ORG_CODE = (SELECT A.OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance A WHERE A.OrgForCompliance_ORG_CODE='$acr' ))) AS AssigCode");

        $OrgType = mysqli_query($con,"(SELECT OC.AssOrgCategory_ORGCAT_CODE as OrgType FROM t_assign_org_category OC WHERE OC.AssOrgCategory_ORG_CODE = (SELECT A.OrgForCompliance_OrgApplProfile_APPL_CODE FROM t_org_for_compliance A WHERE A.OrgForCompliance_ORG_CODE='$acr'))");

        while($frow=mysqli_fetch_array($OrgType)){
            if($frow["OrgType"]=='ACAD_ORG')
            {
                mysqli_query($con,"INSERT INTO `t_assign_org_category` 
                (`AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`) 
                VALUES ('$acr','ACAD_ORG')");

                while($Afrow=mysqli_fetch_array($AssignCode)){
                    $course = $Afrow["AssigCode"];
                    mysqli_query($con,"INSERT INTO `t_assign_org_academic_course` 
                    (`AssOrgAcademic_ORG_CODE`, `AssOrgAcademic_COURSE_CODE`) 
                    VALUES ('$acr','$course')");

                }
            }
            else if($frow["OrgType"]=='NONACAD_ORG'){

                mysqli_query($con,"INSERT INTO `t_assign_org_category` 
                (`AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`) 
                VALUES ('$acr','NONACAD_ORG')");
                
                while($Afrow=mysqli_fetch_array($AssignCode)){
                    $NonAcad = $Afrow["AssigCode"];
                    mysqli_query($con,"INSERT INTO `t_assign_org_non_academic` 
                    (`AssOrgNonAcademic_ORG_CODE`, `AssOrgNonAcademic_NON_ACAD`) 
                    VALUES ('$acr','$NonAcad')");

                }
            }else {
                $typeOrg =$frow["OrgType"];
                mysqli_query($con,"INSERT INTO `t_assign_org_category` 
                (`AssOrgCategory_ORG_CODE`, `AssOrgCategory_ORGCAT_CODE`) 
                VALUES ('$acr','$typeOrg')");
            }
        }

        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','President','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Vice-President of internal affair','1')  ");       
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Vice-President of external affair','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Budget and Finance','1')  ");       
        
        $query = mysqli_query($con,"INSERT INTO r_org_officer_position_details (OrgOffiPosDetails_ORG_CODE,OrgOffiPosDetails_NAME,OrgOffiPosDetails_NumOfOcc) VALUES ('$acr','Auditor','1')  ");       
                
	}

?>
