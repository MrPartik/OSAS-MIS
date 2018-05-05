<?php
	
include('../../../config/connection.php');     
    if(isset($_POST['_name']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        
        $name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$date = $_POST['_date'];
		$org = $_POST['_org'];
		$code = $_POST['_code'];
        

        $query = mysqli_prepare($con, "UPDATE r_org_event_management SET OrgEvent_DATE_MOD = CURRENT_TIMESTAMP,OrgEvent_OrgCode = ?, OrgEvent_NAME = ?,OrgEvent_DESCRIPTION = ?,OrgEvent_PROPOSED_DATE = ? WHERE OrgEvent_Code = ? ");
        mysqli_stmt_bind_param($query, 'sssss' ,$org,$name,$desc,$date,$code);
        mysqli_stmt_execute($query);
        
    }       
    else{
        include('../../../Retrict.php');
        
    }
	
    
?>
