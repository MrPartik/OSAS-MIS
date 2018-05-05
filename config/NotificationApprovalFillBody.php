<?php

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        
        include('connection.php'); 
        session_start();
        $role = $_SESSION['logged_user']['role'];
        $container = '';
        $remitnum = $_POST['remitnum'];
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
            $query = mysqli_prepare($con, "SELECT OrgRemittance_APPROVED_STATUS,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION,OrgRemittance_ORG_CODE,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT ,OrgRemittance_DESC FROM `t_org_remittance` 
            INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgRemittance_ORG_CODE
            INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE OrgRemittance_NUMBER = ? ");
            mysqli_stmt_bind_param($query, 's', $remitnum);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgRemittance_APPROVED_STATUS'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $orgcode = $row['OrgRemittance_ORG_CODE'];
                $sendby = $row['OrgRemittance_SEND_BY'];
                $recby = $row['OrgRemittance_REC_BY'];
                $amount = $row['AMOUNT'];
                $desc = $row['OrgRemittance_DESC'];
                
                
            }
            
            $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$orgcode' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
            while($row = mysqli_fetch_assoc($view_query))
            {
                $amount2 = $row["AMOUNT"];
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
                
                               
                                    
            $container = $container . 
                                    '
                            </a>                    
                            <h1 id="lblorgname">'.$orgname . ' - ' . $orgcode .'</h1>
                            <p id="lblorgdesc">'.$orgdesc.'</p>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="javascript:;"> <i class="fa fa-money"></i> Money <span class="badge label-label pull-right r-activity" id="lblmoney">'.$amount2.'</span></a></li>
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Remittance Number<span class="badge label-label pull-right r-activity" id="lblremitnum" item="'.$remitnum.'">'.$remitnum.'</span> </a></li>';
            if($status == 'Pending'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Send By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$sendby.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Amount <span class="badge label-label pull-right r-activity"  id="lblamount">'.$amount.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a></li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-12" style="margin:10px;">
                                        <center>
                                        <a class="btn btn-success approvedModal" style="width:100px" href="javascript:;"><i class="fa fa-thumbs-o-up"></i></a> 
                                        <a class="btn btn-danger rejectModal"  style="width:100px"  href="javascript:;"><i class="fa fa-thumbs-o-down"></i></a>
                                        </center>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>';
                
            }
            else if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-success pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Send By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$sendby.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-reply "></i> Received By <span class="badge label-label pull-right r-activity" id="lblrecby">'.$recby.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Amount <span class="badge label-label pull-right r-activity"  id="lblamount">'.$amount.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a></li>                            
                        </ul>';
                
            }
            else{
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-danger pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Send By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$sendby.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-reply "></i> Received By <span class="badge label-label pull-right r-activity" id="lblrecby">'.$recby.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-flag"></i> Amount <span class="badge label-label pull-right r-activity"  id="lblamount">'.$amount.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a></li>
            </ul>'; 
            }
                            
            echo $container;   
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, "SELECT OrgRemittance_APPROVED_STATUS,OrgAppProfile_NAME,OrgAppProfile_DESCRIPTION,OrgRemittance_ORG_CODE,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,CONCAT('₱', FORMAT(OrgRemittance_AMOUNT, 3)) AS AMOUNT ,OrgRemittance_DESC FROM `t_org_remittance` 
            INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgRemittance_ORG_CODE
            INNER JOIN r_org_applicant_profile ON OrgAppProfile_APPL_CODE = OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE OrgRemittance_NUMBER = ? ");
            mysqli_stmt_bind_param($query, 's', $remitnum);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgRemittance_APPROVED_STATUS'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $orgcode = $row['OrgRemittance_ORG_CODE'];
                $sendby = $row['OrgRemittance_SEND_BY'];
                $recby = $row['OrgRemittance_REC_BY'];
                $amount = $row['AMOUNT'];
                $desc = $row['OrgRemittance_DESC'];
                
                
            }
            
            $view_query = mysqli_query($con," SELECT CONCAT('₱',FORMAT(IFNULL(SUM(OrgRemittance_AMOUNT),0),3)) AS AMOUNT FROM `t_org_remittance` WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = '$orgcode' AND OrgRemittance_APPROVED_STATUS = 'Approved' ");
            while($row = mysqli_fetch_assoc($view_query))
            {
                $amount2 = $row["AMOUNT"];
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
                
            $container = $container . 
                                    '
                            </a>                    
                            <h1 id="lblorgname">'.$orgname . ' - ' . $orgcode .'</h1>
                            <p id="lblorgdesc">'.$orgdesc.'</p>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="javascript:;"> <i class="fa fa-money"></i> Money <span class="badge label-label pull-right r-activity" id="lblmoney">'.$amount2.'</span></a></li>
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Remittance Number<span class="badge label-label pull-right r-activity" id="lblremitnum" item="'.$remitnum.'">'.$remitnum.'</span> </a></li>';
            if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-success pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Send By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$sendby.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-mail-reply "></i> Received By <span class="badge label-label pull-right r-activity" id="lblrecby">'.$recby.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-flag"></i> Amount <span class="badge label-label pull-right r-activity"  id="lblamount">'.$amount.'</span></a></li>
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a></li>                            
                        </ul>';
                
            }
            else{
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="badge label-danger pull-right r-activity" id="lblstat">'.$status.'</span> </a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-forward"></i> Send By <span class="badge label-label pull-right r-activity" id="lblsendby">'.$sendby.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-mail-reply "></i> Received By <span class="badge label-label pull-right r-activity" id="lblrecby">'.$recby.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-flag"></i> Amount <span class="badge label-label pull-right r-activity"  id="lblamount">'.$amount.'</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Description <span class="badge label-label pull-right r-activity"  id="lbldesc">'.$desc.'</span></a></li>
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
