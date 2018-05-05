<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $item = $_POST['item'];
        session_start();
        $username = $_SESSION['logged_user']['username'];
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, " UPDATE r_notification SET Notification_CLICKED = 'Clicked',Notification_DATE_CLICKED = CURRENT_TIMESTAMP WHERE Notification_ITEM = ? ");
            mysqli_stmt_bind_param($query, 's', $item);
            mysqli_stmt_execute($query);
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, " UPDATE r_notification SET Notification_CLICKED = 'Clicked',Notification_DATE_CLICKED = CURRENT_TIMESTAMP WHERE Notification_ITEM = ? ");
            mysqli_stmt_bind_param($query, 's', $item); 
            mysqli_stmt_execute($query);
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
