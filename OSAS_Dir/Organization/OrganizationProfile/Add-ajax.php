<?php
	
include('../../../config/connection.php');     

	if(isset($_POST['_name']))
	{
		
		$name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$accstat = $_POST['_accstat'];
        
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
        $query = mysqli_query($con,"INSERT INTO r_org_applicant_profile (OrgAppProfile_APPL_CODE,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION,OrgAppProfile_STATUS)  VALUES (CONCAT('$acr',YEAR(CURRENT_DATE)),'$name','$desc','$accstat')");
        
	}

?>
