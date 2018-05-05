<?php

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        
        include('connection.php'); 
        session_start();
        $role = $_SESSION['logged_user']['role'];
        $container = '';
        $remitnum = $_POST['event'];
        $status = '';
        $orgname = '';
        $orgdesc = '';
        $orgcode = '';
        $sendby = '';
        $recby = '';
        $amount = '';
        $money = '';
        $desc = '';
        
        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, "SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgForCompliance_ORG_CODE,OrgAppProfile_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE OrgEvent_Code = ? ");
            mysqli_stmt_bind_param($query, 's', $remitnum);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgEvent_STATUS'];
                $eventname = $row['OrgEvent_NAME'];
                $eventdesc = $row['OrgEvent_DESCRIPTION'];
                $orgcode = $row['OrgForCompliance_ORG_CODE'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $date = $row['PROPDATE'];
                $rev = $row['OrgEvent_ReviewdBy'];
                
                
            }
            $container = $container . 
                    '
                        <div class="user-heading alt gray-bg">
                            <a href="#">';
            $file = "../Avatar/".$orgcode.".png";
            if(file_exists(basename($file))) {
                $container = $container . '<img alt="" src="../Avatar/'.$orgcode.'.png">';
            }
            else{
                $container = $container . '<img alt="" src="../Avatar/Default-Organization.png">';
                
            }
                
            $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$orgcode' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
            while($row = mysqli_fetch_assoc($view_query))
            {
                $amount2 = $row["AMOUNT"];
            }   
                                    
            $container = $container . 
                                    '
                            </a>                    
                            <h1 id="lblorgname">'.$orgname . ' - ' . $orgcode .'</h1>
                            <p id="lblorgdesc">'.$orgdesc.'</p>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="javascript:;"> <i class="fa fa-money"></i> Money <span class="badge label-label pull-right r-activity" id="lblmoney">'.$amount2.'</span></a></li>
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Event Code<span class="badge label-label pull-right r-activity" id="lbleventcode" item="'.$remitnum.'">'.$remitnum.'</span> </a></li>';
            
            if($status == 'Pending'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Event Name <span class="badge label-label pull-right r-activity" id="lblsendby">'.$eventname.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Event Description <span class="badge label-label pull-right r-activity"  id="lblamount">'.$eventdesc.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$date.'</span></a></li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-12" style="margin:10px;">
                                        <center>
                                        <a class="btn btn-success EventApprovedModal" style="width:100px" href="javascript:;"><i class="fa fa-thumbs-o-up"></i></a> 
                                        <a class="btn btn-danger EventRejectModal"  style="width:100px"  href="javascript:;"><i class="fa fa-thumbs-o-down"></i></a>
                                        </center>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>';
                
            }
            else if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Reviewed By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$rev.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Event Name <span class="badge label-label pull-right r-activity" id="lblsendby">'.$eventname.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Event Description <span class="badge label-label pull-right r-activity"  id="lblamount">'.$eventdesc.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$date.'</span></a></li>
                          </ul>';
                
            }
            else{
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-danger pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Reviewed By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$rev.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Event Name <span class="badge label-label pull-right r-activity" id="lblsendby">'.$eventname.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-flag"></i> Event Description <span class="badge label-label pull-right r-activity"  id="lblamount">'.$eventdesc.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$date.'</span></a></li>
              </ul>'; 
            }
                            
            echo $container;   
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, "SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgForCompliance_ORG_CODE,OrgAppProfile_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE OrgEvent_Code = ? ");
            mysqli_stmt_bind_param($query, 's', $remitnum);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgEvent_STATUS'];
                $eventname = $row['OrgEvent_NAME'];
                $eventdesc = $row['OrgEvent_DESCRIPTION'];
                $orgcode = $row['OrgForCompliance_ORG_CODE'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $date = $row['PROPDATE'];
                $rev = $row['OrgEvent_ReviewdBy'];
                
                
            }
            $container = $container . 
                    '
                        <div class="user-heading alt gray-bg">
                            <a href="#">';
            $file = "../Avatar/".$orgcode.".png";
            if(file_exists(basename($file))) {
                $container = $container . '<img alt="" src="../Avatar/'.$orgcode.'.png">';
            }
            else{
                $container = $container . '<img alt="" src="../Avatar/Default-Organization.png">';
                
            }
                
            $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$orgcode' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
            while($row = mysqli_fetch_assoc($view_query))
            {
                $amount2 = $row["AMOUNT"];
            }   
                                    
            $container = $container . 
                                    '
                            </a>                    
                            <h1 id="lblorgname">'.$orgname . ' - ' . $orgcode .'</h1>
                            <p id="lblorgdesc">'.$orgdesc.'</p>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="javascript:;"> <i class="fa fa-money"></i> Money <span class="badge label-label pull-right r-activity" id="lblmoney">'.$amount2.'</span></a></li>
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Event Code<span class="badge label-label pull-right r-activity" id="lbleventcode" item="'.$remitnum.'">'.$remitnum.'</span> </a></li>';
            
            if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Reviewed By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$rev.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Event Name <span class="badge label-label pull-right r-activity" id="lblsendby">'.$eventname.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Event Description <span class="badge label-label pull-right r-activity"  id="lblamount">'.$eventdesc.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$date.'</span></a></li>
                          </ul>';
                
            }
            else{
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-danger pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Reviewed By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$rev.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Event Name <span class="badge label-label pull-right r-activity" id="lblsendby">'.$eventname.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-flag"></i> Event Description <span class="badge label-label pull-right r-activity"  id="lblamount">'.$eventdesc.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$date.'</span></a></li>
              </ul>'; 
            }
                            
            echo $container;  
            
        }
                        

                        
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>
