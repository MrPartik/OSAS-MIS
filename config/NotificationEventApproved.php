<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $item = $_POST['item'];
        session_start();
        $id = $_SESSION['logged_user']['username'];
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, " UPDATE r_org_event_management SET OrgEvent_STATUS = 'Approved',OrgEvent_DATE_MOD=CURRENT_TIMESTAMP,OrgEvent_ReviewdBy = '$id' WHERE OrgEvent_Code = ? ");
            mysqli_stmt_bind_param($query, 's', $item);
            mysqli_stmt_execute($query);
                        
            $query = mysqli_prepare($con, "SELECT OrgEvent_OrgCode FROM `r_org_event_management` WHERE OrgEvent_Code = ?");
            mysqli_stmt_bind_param($query, 's', $item);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            $rec = '';
            while($row = mysqli_fetch_assoc($result)){
                $rec = $row['OrgEvent_OrgCode'];
            }
            
            $query = mysqli_prepare($con, "INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES (?,'Organization',(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'),?)");
            mysqli_stmt_bind_param($query, 'ss', $item,$rec);
            mysqli_stmt_execute($query);
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
