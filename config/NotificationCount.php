<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $notification = '';
        session_start();
        
        $role = $_SESSION['logged_user']['role'];
<<<<<<< HEAD
        $username = $_SESSION['logged_user']['username'];
        
        if($role == 'OSAS HEAD'){
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_RECEIVER = (SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active') AND Notification_SEEN = 'Unseen'  ");
=======
        
        if($role == 'OSAS HEAD'){
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_USERROLE = 'OSAS HEAD' AND Notification_SEEN = 'Unseen'  ");
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
            while($row = mysqli_fetch_assoc($view_query)){
                $notification = $row['COU'];
            }
            if($notification > 0){

                    echo 
                        '<span class="badge bg-warning" id="noticationCount">' .
                        $notification . '
                        </span>';

<<<<<<< HEAD
            }
                      
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, "SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_USERROLE = 'Organization' AND Notification_SEEN = 'Unseen' AND Notification_RECEIVER = ?");
            mysqli_stmt_bind_param($query, 's', $username);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            $rec = '';
            while($row = mysqli_fetch_assoc($result)){
                $notification = $row['COU'];
            }

            if($notification > 0){

                echo 
                    '<span class="badge bg-warning" id="noticationCount">' .
                    $notification . '
                    </span>';

            }
=======
                }
>>>>>>> e5642f42baf974fe8cbd016478bb82bcfd5d637b
                      
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
