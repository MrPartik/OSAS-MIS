<?php  
 if(!empty($_FILES["employee_file2"]["name"]))  
 {  
    include('../../../config/connection.php');     
      $output = '';  
      $allowed_ext = array("csv");  
     $container_arr = array();
          $org = $_GET['Orgcode'];

      $extension = end(explode(".", $_FILES["employee_file2"]["name"]));  
      if(in_array($extension, $allowed_ext))  
      {  
           $file_data = fopen($_FILES["employee_file2"]["tmp_name"], 'r');  
           fgetcsv($file_data);  
           while($row = fgetcsv($file_data))  
           {  
                $studnum = mysqli_real_escape_string($con, $row[0]);  
                $pos = mysqli_real_escape_string($con, $row[1]);  
               
               
                $queryy = mysqli_query($con,"INSERT INTO r_org_officer_position_details  
                     (OrgOffiPosDetails_NAME, OrgOffiPosDetails_ORG_CODE)  
                     VALUES ('$studnum', ,(SELECT OrgForCompliance_ORG_CODE FROM `t_org_for_compliance` WHERE OrgForCompliance_OrgApplProfile_APPL_CODE = '$org' AND OrgForCompliance_DISPAY_STAT = 'Active'))");
               
                   $arr = array(
                    'snum'  => $studnum
                   );
                array_push(  $container_arr, (array)$arr );
        
        
        
           }  
            echo json_encode($container_arr);
      }  
      else  
      {  
           echo 'Error1';  
      }  
 }  
 else  
 {  
      echo "Error2";  
 }  
 ?>
