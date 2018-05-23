<?php
	
    include('../../config/connection.php');     
    include('../../config/query.php');
    if(isset($_POST['_name']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        session_start();
        $orgcode = $_SESSION['logged_user']['username'];
        $name = $_POST['_name'];
		$desc = $_POST['_desc'];
		$date = $_POST['_date'];
        
        $query = mysqli_prepare($con, "SELECT CONCAT('EVNT',RIGHT(100000+count(*)+1,5)) AS CODE FROM r_org_event_management");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $code = '';
        while($row = mysqli_fetch_assoc($result)){
            $code = $row['CODE'];
        }

        if(isset($_FILES['file'])){
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $filename = 'EventDocu-'.$current_acadyear.'-'.$current_semster.'-'.$orgcode.'-'.$name.'.'.$ext;
            $url = '../../Documents/'.$filename;

            // Check for errors
            if($_FILES['file']['error'] > 0){
                die('EWU');
            }

            // Check filesize
            if($_FILES['file']['size'] > 10485760){
                die('ES');
            }

            // Check if the file exists
            if(file_exists('../../Documents/' . $_FILES['file']['name'])){
                die('AE');
            }

            // Upload file
            if(!move_uploaded_file($_FILES['file']['tmp_name'], '../../Documents/' . $filename)){
                die('CD');
            }

        
        $query = mysqli_prepare($con, "INSERT INTO r_org_event_management (OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_PROPOSED_DATE,OrgEvent_FILES) VALUES (?,?,?,?,?,?)");
        mysqli_stmt_bind_param($query, 'ssssss',$orgcode,$code,$name,$desc,$date,$url);
        mysqli_stmt_execute($query);

        }
        
        $query = mysqli_prepare($con, "INSERT INTO r_notification (Notification_ITEM,Notification_USERROLE,Notification_SENDER,Notification_RECEIVER) VALUES (?,'Organization',?,(SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active'))");
        mysqli_stmt_bind_param($query, 'ss', $code,$orgcode);
        mysqli_stmt_execute($query);

        
    }       
    else{
        include('../../Retrict.php');
        
    }
	
    
?>
