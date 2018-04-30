<?php
	
    include('connection.php');     
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        $notification = '';
        session_start();
        
        $role = $_SESSION['logged_user']['role'];
        
        if($role == 'OSAS HEAD'){
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_USERROLE = 'OSAS HEAD' AND Notification_SEEN = 'Unseen'  ");
            while($row = mysqli_fetch_assoc($view_query)){
                $notification = $row['COU'];
            }
            if($notification > 0){

                    echo 
                        '<span class="badge bg-warning" id="noticationCount">' .
                        $notification . '
                        </span>';

                }
                      
        }
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
