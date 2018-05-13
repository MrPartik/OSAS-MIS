<?php

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        
        include('connection.php'); 
        session_start();
        $role = $_SESSION['logged_user']['role'];
        $container = '';
        $vouchNo = $_POST['event'];
        $status = '';
        $orgname = '';
        $orgdesc = '';
        $orgcode = '';
        $sendby = '';
        $recby = '';
        $amount = '';
        $money = '';
        $desc = '';
        
        $amountQuery = mysqli_fetch_assoc(mysqli_query($con,"Select CONCAT('₱ ',FORMAT(IFNULL(SUM(OrgVouchItems_AMOUNT),0),3)) AS amo
         from t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$vouchNo'"));
        $amount = $amountQuery['amo'];

        $countItemsQuery = mysqli_fetch_assoc(mysqli_query($con,"Select count(OrgVouchItems_AMOUNT) AS cou
         from t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$vouchNo'"));
        $countItems = $countItemsQuery['cou'];


        if($role == 'OSAS HEAD'){
            $query = mysqli_prepare($con, "SELECT * FROM `r_notification` N
            INNER JOIN t_org_voucher OV ON N.Notification_Item = OV.OrgVoucher_CASH_VOUCHER_NO
            INNER JOIN t_org_for_compliance AS R ON ov.OrgVoucher_ORG_CODE = R.OrgForCompliance_ORG_CODE
            INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE ov.OrgVoucher_CASH_VOUCHER_NO = '$vouchNo' "); 
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgVoucher_STATUS'];  
                $orgcode = $row['OrgForCompliance_ORG_CODE'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $date = $row['OrgVoucher_DATE_ADD'];
                $VouchBy = $row['OrgVoucher_VOUCHED_BY'];
                $CheckBy = $row['OrgVoucher_CHECKED_BY']; 
                
            }
            $container = $container . 
                    '<div class="user-heading alt gray-bg">
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
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Voucher Code<span class="label label-success label-success pull-right r-activity" id="lbleventcode" item="'.$vouchNo.'">'.$vouchNo.'</span> </a></li> <li><a href="javascript:;"><i class="fa fa-money"></i>Total Vouched<span  class="label label-success label-success pull-right r-activity">'.$amount.'</span> </a></li> <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Number of Item/s Vouched<span class="label label-info label-success pull-right r-activity">'.$countItems.'</span> &nbsp;</a></li>';
                          
                          
                            $ItemsQuery = mysqli_query($con,"Select CONCAT('₱ ',FORMAT(IFNULL(OrgVouchItems_AMOUNT,0),3)) AS amo,OrgVouchItems_ITEM_NAME from t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$vouchNo'"); 
                            while($row = mysqli_fetch_assoc($ItemsQuery)){

                            $container .=   '<li><a href="javascript:;" style=" margin-left: 10%;  "><i class="fa fa-tag"></i>'.$row['OrgVouchItems_ITEM_NAME'].'<span class="label label-success label-info pull-right r-activity">'.$row['amo'].'</span> &nbsp;</a></li>';
                            }
                        
            
            if($status == 'Pending'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="label label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li> 
                            <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date Issued <span class="label label-primary pull-right r-activity"  id="lbldesc">'.(new DateTime($date))->format('D M d, Y h:i A').'</span></a></li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-12" style="margin:10px;">
                                        <center>
                                        <a class="btn btn-success VouchApprovedModal" style="width:100px" href="javascript:;"><i class="fa fa-thumbs-o-up"></i></a> 
                                        <a class="btn btn-danger VouchRejectModal"  style="width:100px"  href="javascript:;"><i class="fa fa-thumbs-o-down"></i></a>
                                        </center>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>';
                
            }
            else if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="label label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li> 
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date Issued <span class="label label-primary pull-right r-activity"  id="lbldesc">'.(new DateTime($date))->format('D M d, Y h:i A').'</span></a></li>
                          </ul>';
                
            } 
                            
            echo $container;   
        }
        else if($role == 'Organization'){
            $query = mysqli_prepare($con, "SELECT * FROM `r_notification` N
            INNER JOIN t_org_voucher OV ON N.Notification_Item = OV.OrgVoucher_CASH_VOUCHER_NO
            INNER JOIN t_org_for_compliance AS R ON ov.OrgVoucher_ORG_CODE = R.OrgForCompliance_ORG_CODE
            INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE
            WHERE ov.OrgVoucher_CASH_VOUCHER_NO = '$vouchNo' "); 
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
            while($row = mysqli_fetch_assoc($result)){
                $status = $row['OrgVoucher_STATUS'];  
                $orgcode = $row['OrgForCompliance_ORG_CODE'];
                $orgname = $row['OrgAppProfile_NAME'];
                $orgdesc = $row['OrgAppProfile_DESCRIPTION'];
                $date = $row['OrgVoucher_DATE_ADD'];
                $VouchBy = $row['OrgVoucher_VOUCHED_BY'];
                $CheckBy = $row['OrgVoucher_CHECKED_BY']; 
                
            }
            $container = $container . 
                    '<div class="user-heading alt gray-bg">
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
                            <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Voucher Code<span class="label label-success label-success pull-right r-activity" id="lbleventcode" item="'.$vouchNo.'">'.$vouchNo.'</span> </a></li> <li><a href="javascript:;"><i class="fa fa-money"></i>Total Vouched<span  class="label label-success label-success pull-right r-activity">'.$amount.'</span> </a></li> <li><a href="javascript:;"><i class="fa fa-bookmark"></i>Number of Item/s Vouched<span class="label label-info label-success pull-right r-activity">'.$countItems.'</span> &nbsp;</a></li>';
                          
                          
                            $ItemsQuery = mysqli_query($con,"Select CONCAT('₱ ',FORMAT(IFNULL(OrgVouchItems_AMOUNT,0),3)) AS amo,OrgVouchItems_ITEM_NAME from t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$vouchNo'"); 
                            while($row = mysqli_fetch_assoc($ItemsQuery)){

                            $container .=   '<li><a href="javascript:;" style=" margin-left: 10%;  "><i class="fa fa-tag"></i>'.$row['OrgVouchItems_ITEM_NAME'].'<span class="label label-success label-info pull-right r-activity">'.$row['amo'].'</span> &nbsp;</a></li>';
                            }
            
            if($status == 'Approved'){
                $container = $container . '<li><a href="javascript:;"><i class="fa fa-info-circle"></i>Status<span class="label label-primary pull-right r-activity" id="lblstat">'.$status.'</span> </a></li> 
                <li><a href="javascript:;"> <i class="fa fa-comments-o"></i> Date Issued <span class="label label-primary pull-right r-activity"  id="lbldesc">'.(new DateTime($date))->format('D M d, Y h:i A').'</span></a></li>
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
