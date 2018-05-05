<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        
        session_start();
<<<<<<< HEAD
        $username = $_SESSION['logged_user']['username'];
=======
        $id = $_SESSION['logged_user']['username'];
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
<<<<<<< HEAD
            $view_query = mysqli_query($con," UPDATE r_notification SET Notification_SEEN = 'Seen',Notification_DATE_SEEN = CURRENT_TIMESTAMP WHERE Notification_RECEIVER = (SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active') AND Notification_SEEN = 'Unseen' ");
          
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, "UPDATE r_notification SET Notification_SEEN = 'Seen',Notification_DATE_SEEN = CURRENT_TIMESTAMP WHERE Notification_USERROLE = 'Organization' AND Notification_SEEN = 'Unseen' AND Notification_RECEIVER = ? ");
            mysqli_stmt_bind_param($query, 's', $username);
            mysqli_stmt_execute($query); 
=======
          $view_query = mysqli_query($con," UPDATE r_notification SET Notification_SEEN = 'Seen',Notification_DATE_SEEN = CURRENT_TIMESTAMP WHERE Notification_USERROLE = 'OSAS Head' AND Notification_SEEN = 'Unseen' ");
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
          
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
