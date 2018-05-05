<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $item = $_POST['item'];
        session_start();
<<<<<<< HEAD
        $username = $_SESSION['logged_user']['username'];
=======
        $id = $_SESSION['logged_user']['username'];
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, " UPDATE r_notification SET Notification_CLICKED = 'Clicked',Notification_DATE_CLICKED = CURRENT_TIMESTAMP WHERE Notification_ITEM = ? ");
            mysqli_stmt_bind_param($query, 's', $item);
            mysqli_stmt_execute($query);
        }
<<<<<<< HEAD
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, " UPDATE r_notification SET Notification_CLICKED = 'Clicked',Notification_DATE_CLICKED = CURRENT_TIMESTAMP WHERE Notification_ITEM = ? ");
            mysqli_stmt_bind_param($query, 's', $item); 
            mysqli_stmt_execute($query);
        }
=======
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
