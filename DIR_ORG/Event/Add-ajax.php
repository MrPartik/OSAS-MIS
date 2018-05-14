<?php
	
    include('../../config/connection.php');     
    if(isset($_POST['_name']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        session_start();
        
        $orgcode = $_SESSION['logged_user']['username'];
        $name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$date = $_POST['_date'];
        
        $query = mysqli_prepare($con, "SELECT CONCAT('EVNT',RIGHT(100000+count(*)+1,5)) AS CODE FROM r_org_event_management");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $code = '';
        while($row = mysqli_fetch_assoc($result)){
            $code = $row['CODE'];
        }
        
//        $query = mysqli_prepare($con, "INSERT INTO r_org_event_management (OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_PROPOSED_DATE) VALUES (?,?,?,?,STR_TO_DATE(REPLACE(?,'/','.'),GET_FORMAT(DATE,'USA')))");
        $query = mysqli_prepare($con, "INSERT INTO r_org_event_management (OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_PROPOSED_DATE) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($query, 'sssss',$orgcode,$code ,$name,$desc,$date);
        mysqli_stmt_execute($query);
        
        $query = mysqli_prepare($con, "INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES (?,'Organization',?,(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'))");
        mysqli_stmt_bind_param($query, 'ss', $code,$orgcode);
        mysqli_stmt_execute($query);

        
    }       
    else{
        include('../../Retrict.php');
        
    }
	
    
?>
