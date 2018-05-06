<?php  
    $notification = '';
    $role = $_SESSION['logged_user']['role'];
    if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in'])){ 
        header("location:../");
    }
    else{
        if($role == "OSAS HEAD" ){
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_USERROLE = 'OSAS HEAD' AND Notification_SEEN = 'Unseen'  ");
            while($row = mysqli_fetch_assoc($view_query)){
                $notification = $row['COU'];
            }
            
        }
        else if($role == "Organization" ){
            $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_notification WHERE Notification_USERROLE = 'Organization' AND Notification_SEEN = 'Unseen'  ");
            while($row = mysqli_fetch_assoc($view_query)){
                $notification = $row['COU'];
            }
            
        }
        
    }
?>
<li id="header_notification_bar" class="dropdown" >
    <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="btnnotif">
        <i class="fa fa-bell-o"></i>
        <div id="notificationCount">
            
        </div>
    </a>
    <ul class="dropdown-menu extended notification" id="notificationlist" >
        <li>
            <p> Notifications (<?php echo $count_notif ?>)</p>
        </li>
        <div id="notificationContainer" style="overflow-y:scroll; height: 400px;" ">
            
        </div>
        
    </ul>
</li> 

