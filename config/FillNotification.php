<?php 
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        include('connection.php');
        session_start();
        $role = $_SESSION['logged_user']['role'];
        $username = $_SESSION['logged_user']['username'];
        
        if($role == 'OSAS HEAD'){
            $view_query = mysqli_query($con,"SELECT *,DATE_FORMAT(Notification_DATE_SEEN, '%M %d, %Y %l:%i %p ') AS DATESEEN,DATE_FORMAT(Notification_DATE_CLICKED, '%M %d, %Y %l:%i %p ') AS DATECLICK, IF(LEFT(Notification_ITEM,5) = 'Remit',(SELECT OrgRemittance_ORG_CODE FROM t_org_remittance WHERE OrgRemittance_NUMBER = Notification_ITEM ),'') AS SENDBY FROM `r_notification` 
            WHERE Notification_RECEIVER = (SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active')
             
            ORDER BY Notification_DATE_ADDED DESC ");
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
                    $container = $container. '<span  class="alert-icon"><i class="fa fa-money"></i></span>
                                                <div  class="noti-info">
                                <a class="notif" data-toggle="modal" href="#RemittanceApproval"   item="'.$row['Notification_ITEM'].'"> '.$row['Notification_ITEM']. ' - ' .$row['SENDBY'].'</a>';

                }
                else if(substr($row['Notification_ITEM'],0,4) == 'EVNT'){
                    $event = $row['Notification_ITEM'];
                    $view_query2 = mysqli_query($con,"SELECT OrgEvent_NAME,OrgAppProfile_NAME FROM `r_org_event_management` AS E
                    INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                    INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                    WHERE OrgEvent_Code = '$event'");
                    
                        
                    while($row2 = mysqli_fetch_assoc($view_query2)){
                        $container = $container. '<span class="alert-icon"><i class="fa fa-bookmark"></i></span>
                                        <div class="noti-info">
                        <a class="notif" data-toggle="modal" href="#EventApproval" href="javascript:;" item="'.$row['Notification_ITEM'].'"> '.$row2['OrgEvent_NAME'].'</a><br/>
                        <label class="" style="font-size:10px"> '. $row2['OrgAppProfile_NAME'] .'</label>' ;

                    } 
                }
                else if(substr($row['Notification_ITEM'],0,5) == 'Vouch'){
                    $vouch = $row['Notification_ITEM'];
                    $view_query3 = mysqli_query($con,"SELECT distinct OrgVoucher_ORG_CODE,OrgAppProfile_NAME FROM `r_notification` N
                    INNER JOIN t_org_voucher OV ON N.Notification_Item = OV.OrgVoucher_CASH_VOUCHER_NO
                    INNER JOIN t_org_for_compliance AS R ON ov.OrgVoucher_ORG_CODE = R.OrgForCompliance_ORG_CODE
                    INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                    WHERE ov.OrgVoucher_CASH_VOUCHER_NO = '$vouch' ");
                    
                        
                    while($row2 = mysqli_fetch_assoc($view_query3)){
                        $container = $container. '<span class="alert-icon"><i class="fa fa-money"></i></span>
                                        <div class="noti-info">
                        <a class="notif" data-toggle="modal" href="#VoucherApproval" href="javascript:;" item="'. $vouch.'"> '. $vouch .' - '.$row2['OrgVoucher_ORG_CODE'].'</a><br/>
                        <label class="" style="font-size:10px"> '. $row2['OrgAppProfile_NAME'] .'</label>' ;

                    } 
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
            echo $container ;
        
        }



        if($role == 'Organization'){
            $query = mysqli_prepare($con, "SELECT *,DATE_FORMAT(Notification_DATE_SEEN, '%M %d, %Y %l:%i %p ') AS DATESEEN,DATE_FORMAT(Notification_DATE_CLICKED, '%M %d, %Y %l:%i %p ') AS DATECLICK, IF(LEFT(Notification_ITEM,5) = 'Remit',(SELECT OrgRemittance_ORG_CODE FROM t_org_remittance WHERE OrgRemittance_NUMBER = Notification_ITEM ),'') AS SENDBY FROM `r_notification` WHERE Notification_RECEIVER = ? ORDER BY Notification_DATE_ADDED DESC");
            mysqli_stmt_bind_param($query, 's', $username);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            $container = '';
            while($row = mysqli_fetch_assoc($result)){
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
                else if(substr($row['Notification_ITEM'],0,4) == 'EVNT'){
                    $event = $row['Notification_ITEM'];
                    $view_query2 = mysqli_query($con,"SELECT OrgEvent_NAME,OrgAppProfile_NAME FROM `r_org_event_management` AS E
                    INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                    INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                    WHERE OrgEvent_Code = '$event' ");
                    while($row2 = mysqli_fetch_assoc($view_query2)){
                        $container = $container. '<span class="alert-icon"><i class="fa fa-money"></i></span>
                                        <div class="noti-info">
                        <a class="notif" data-toggle="modal" href="#EventApproval" href="javascript:;" item="'.$row['Notification_ITEM'].'"> '.$row2['OrgEvent_NAME'].'</a><br/>
                        <label class="" style="font-size:10px"> '. $row2['OrgAppProfile_NAME'] .'</label>' ;

                    }

                    

                }        else if(substr($row['Notification_ITEM'],0,5) == 'Vouch'){
                    $vouch = $row['Notification_ITEM'];
                    $view_query3 = mysqli_query($con,"SELECT distinct OrgVoucher_ORG_CODE,OrgAppProfile_NAME FROM `r_notification` N
                    INNER JOIN t_org_voucher OV ON N.Notification_Item = OV.OrgVoucher_CASH_VOUCHER_NO
                    INNER JOIN t_org_for_compliance AS R ON ov.OrgVoucher_ORG_CODE = R.OrgForCompliance_ORG_CODE
                    INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
                    WHERE ov.OrgVoucher_CASH_VOUCHER_NO = '$vouch' ");
                    
                        
                    while($row2 = mysqli_fetch_assoc($view_query3)){
                        $container = $container. '<span class="alert-icon"><i class="fa fa-money"></i></span>
                                        <div class="noti-info">
                        <a class="notif" data-toggle="modal" href="#VoucherApproval" href="javascript:;" item="'. $vouch.'"> '. $vouch .' - '.$row2['OrgVoucher_ORG_CODE'].'</a><br/>
                        <label class="" style="font-size:10px"> '. $row2['OrgAppProfile_NAME'] .'</label>' ;

                    } 
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
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

    
   

?>