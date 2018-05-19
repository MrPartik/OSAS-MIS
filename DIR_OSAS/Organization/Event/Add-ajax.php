<?php
	
include('../../../config/connection.php');     
    if(isset($_POST['_name']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        
        $name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$date = $_POST['_date'];
		$org = $_POST['_org'];
        
        $query = mysqli_prepare($con, "SELECT CONCAT('EVNT',RIGHT(100000+count(*)+1,5)) AS CODE FROM r_org_event_management");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $code = '';
        while($row = mysqli_fetch_assoc($result)){
            $code = $row['CODE'];
        }
        
        $id = $_SESSION['logged_user']['username'];
        $view_query = mysqli_query($con," SELECT OSASHead_NAME FROM r_osas_head INNER JOIN r_users ON Users_REFERENCED = OSASHead_CODE WHERE Users_USERNAME = '$id' ");
        while($row = mysqli_fetch_assoc($view_query))
        $id = $row['OSASHead_NAME'];
        
        $query = mysqli_prepare($con, "INSERT INTO r_org_event_management (OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_PROPOSED_DATE) VALUES (?,'Approved',?,?,?,?,?)");
        mysqli_stmt_bind_param($query, 'ssssss',$id,$org,$code ,$name,$desc,$date);
        echo mysqli_stmt_execute($query);
        
        
    }       
    else{
        include('../Retrict.php');
        
    }
	
    
?>
