<?php
	
    include('../../config/connection.php');     
    if(isset($_POST['_code']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

		$code = $_POST['_code'];
        
        $query = mysqli_prepare($con, "UPDATE r_org_event_management SET OrgEvent_DISPLAY_STAT = 'Inactive',OrgEvent_DATE_MOD = CURRENT_TIMESTAMP  WHERE OrgEvent_Code = ?");
        mysqli_stmt_bind_param($query, 's' ,$code);
        mysqli_stmt_execute($query);
        
        
    }       
    else{
        include('../../Retrict.php');
        
    }
	
    
?>
