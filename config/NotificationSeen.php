<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        
        session_start();
        $id = $_SESSION['logged_user']['username'];
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
          $view_query = mysqli_query($con," UPDATE r_notification SET Notification_SEEN = 'Seen',Notification_DATE_SEEN = CURRENT_TIMESTAMP WHERE Notification_USERROLE = 'OSAS Head' AND Notification_SEEN = 'Unseen' ");
          
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
