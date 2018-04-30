<?php 
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        include('connection.php');

        $view_query = mysqli_query($con,"SELECT *,DATE_FORMAT(Notification_DATE_SEEN, '%M %d, %Y %l:%i %p ') AS DATESEEN,DATE_FORMAT(Notification_DATE_CLICKED, '%M %d, %Y %l:%i %p ') AS DATECLICK, IF(LEFT(Notification_ITEM,5) = 'Remit',(SELECT OrgRemittance_ORG_CODE FROM t_org_remittance WHERE OrgRemittance_NUMBER = Notification_ITEM ),'') AS SENDBY FROM `r_notification` ORDER BY Notification_DATE_ADDED DESC ");
        $container = '';
        while($row = mysqli_fetch_assoc($view_query)){
            $container = $container. '<li>';
            if($row['Notification_CLICKED'] == 'Clicked'){
                $container = $container. '<div class="alert alert-success clearfix">';
            }
            else{
                $container = $container. '<div class="alert alert-info clearfix">';
            }
            if(substr($row['Notification_ITEM'],0,5) == 'Remit'){
                $container = $container. '<span class="alert-icon"><i class="fa fa-money"></i></span>
                                            <div class="noti-info">
                            <a class="notif" data-toggle="modal" href="#RemittanceApproval" href="javascript:;" item="'.$row['Notification_ITEM'].'"> '.$row['Notification_ITEM']. ' - ' .$row['SENDBY'].'</a>';
                                                                               
            }
            else{
                $container = $container. '<span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                                            <div class="noti-info">
                            <a href="#" data-toggle="modal" href="#RemittanceApproval" href="javascript:;" class="notif" item="'.$row['Notification_ITEM'].'"> '.$row['SENDBY'].'</a>';
            }

            if($row['Notification_SEEN'] == 'Seen' && $row['Notification_CLICKED'] == 'Unclick' ){
                $container = $container. '<br/><label class="pull-right" style="font-size:10px">Seen: '. $row['DATESEEN'] .'</label> 
                        </div>
                    </div>
                </li>';

            }
            else if($row['Notification_SEEN'] == 'Seen' && $row['Notification_CLICKED'] == 'Clicked'){
                $container = $container. '<br/><label class="pull-right" style="font-size:10px">Recent Viewed: '. $row['DATECLICK'] .'</label> 
                        </div>
                    </div>
                </li>';

            }

        }
        echo $container;
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

    
   

?>