<?php
	
	include('../../connection.php');
	if(isset($_POST['_compcode']))
	{

        $id = $_POST['_getid'];
		$compcode = $_POST['_compcode'];
		$reccode = $_POST['_reccode'];
		$stat = $_POST['_stat'];
        $curcompcode = '';

        $view_query = mysqli_query($connection,"SELECT OFC.OrgForCompliance_ORG_CODE AS COMPCODE FROM `r_org_applicant_profile` AS OAP INNER JOIN t_org_for_compliance AS OFC ON OFC.OrgForCompliance_OrgApplProfile_APPL_CODE = OAP.OrgAppProfile_APPL_CODE  WHERE OrgAppProfile_ID = $id ");
        while($row = mysqli_fetch_assoc($view_query))
        {   
            $curcompcode = $row["COMPCODE"];

        }
        
        
        $result = mysqli_query($connection, "select count(*) as cou from t_org_accreditation_process WHERE OrgAccrProcess_ORG_CODE = '$curcompcode' and OrgAccrProcess_OrgAccrDetail_CODE ='$reccode'");
        while($row = mysqli_fetch_assoc($result))
        {
            $cou = $row["cou"];
        }
        
        if($cou == 0)      
        {
            
            $query = mysqli_query($connection,"INSERT INTO t_org_accreditation_process (OrgAccrProcess_ORG_CODE,OrgAccrProcess_OrgAccrDetail_CODE,OrgAccrProcess_IS_ACCREDITED)  VALUES ('$compcode','$reccode','$stat')");
            
        }
        else
        {
            
            $query = mysqli_query($connection,"Update t_org_accreditation_process SET OrgAccrProcess_ORG_CODE = '$compcode' , OrgAccrProcess_IS_ACCREDITED = '$stat' WHERE OrgAccrProcess_ORG_CODE =  '$curcompcode' and OrgAccrProcess_OrgAccrDetail_CODE = '$reccode'");
            
        }

        
	}

?>
