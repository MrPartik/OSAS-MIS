<?php  
 if(!empty($_FILES["employee_file"]["name"]))  
 {  
      include('../../../config/connection.php');     

      $output = '';  
      $allowed_ext = array("csv");  
     $container_arr = array();
     $org = $_GET['Orgcode'];

//      $extension = end(explode(".", $_FILES["employee_file"]["name"]));
     $extension = pathinfo($_FILES["employee_file"]["name"], PATHINFO_EXTENSION);

      if(in_array($extension, $allowed_ext))  
      {  
           $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');  
           fgetcsv($file_data);  
           while($row = fgetcsv($file_data))  
           {  
                $studnum = mysqli_real_escape_string($con, $row[0]);  
               
               
               $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM t_assign_org_members WHERE  AssOrgMem_STUD_NO= '$studnum' AND AssOrgMem_COMPL_ORG_CODE = '$org'  ");

                while($row = mysqli_fetch_assoc($view_query))
                {
                    $getcou = $row["COU"];

                }
               
               if($getcou == '1')
               {
                 $queryy = mysqli_query($con," UPDATE `t_assign_org_members` SET `AssOrgMem_DISPLAY_STAT` = 'Active' WHERE `t_assign_org_members`.`AssOrgMem_STUD_NO` = '$studnum' AND `t_assign_org_members`.`AssOrgMem_COMPL_ORG_CODE` = '$org' ");
                  ;
                   
               }
               else
               {
               
                $queryy = mysqli_query($con,"INSERT INTO t_assign_org_members  
                     (AssOrgMem_STUD_NO, AssOrgMem_COMPL_ORG_CODE)  
                     VALUES ('$studnum', '$org')");
                   
                   
               }
               
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
