<?php
 if(!empty($_FILES["employee_file"]["name"]))
 {
    include('../../config/connection.php');

    $output = '';
    $allowed_ext = array("csv");
    $container_arr = array();
    session_start();

    $role = $_SESSION['logged_user']['role'];
    $org = $_SESSION['logged_user']['username'];


      //$extension = end(explode(".", $_FILES["employee_file"]["name"]));
        $extension = pathinfo($_FILES["employee_file"]["name"], PATHINFO_EXTENSION);

      if(in_array($extension, $allowed_ext))
      {
           $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');
           fgetcsv($file_data);
           while($row = fgetcsv($file_data))
           {   
               //adding students' sanction info
                $sanction_date =  mysqli_real_escape_string($con, $row[0]);
                $studnum = mysqli_real_escape_string($con, $row[1]);
                $sanction_rmrk =  mysqli_real_escape_string($con, $row[7]);
               //adding designations
                $sanction_plce =  mysqli_real_escape_string($con, $row[6]);
               //adding sanction code,name,and time alloted//
                $sanction_code =  mysqli_real_escape_string($con, $row[3]);
                $sanction_name =  mysqli_real_escape_string($con, $row[4]);
                $sanction_time =  mysqli_real_escape_string($con, $row[5]);
           
               //start adding sanction info 
               $view_query_sanction = mysqli_query($con,"SELECT COUNT(*) AS COUP FROM r_sanction_details WHERE SancDetails_CODE = '$sanction_code'");
               
                //checking if the sanction code is available
                while($row = mysqli_fetch_assoc($view_query_sanction))
                {
                    $getcou = $row["COUP"];

                }
                //sanction code seen
               if($getcou == '1')
               {
                 
                 $querysanc = mysqli_query($con,"UPDATE `r_sanction_details` SET `SancDetails_CODE`='$sanction_code',`SancDetails_NAME`='$sanction_name',`SancDetails_TIMEVAL`='$sanction_time',WHERE `SancDetails_CODE`='$sanction_code'");

               }
               else
               {
                
                $querysanc = mysqli_prepare($con, "INSERT INTO `r_sanction_details`(`SancDetails_CODE`, `SancDetails_NAME`, `SancDetails_TIMEVAL`) VALUES (?,?,?)");
                mysqli_stmt_bind_param($querysanc,'sss',$sanction_code,$sanction_name,$sanction_time);
                mysqli_stmt_execute($querysanc);
              
               }

               $arr = array(
                'sunccode'  => $sanction_code
               );
               array_push( $container_arr, (array)$arr);
               
               
                //start adding place info 
               $view_query_place = mysqli_query($con,"SELECT COUNT(*) AS COUPD FROM r_designated_offices_details WHERE DesOffDetails_NAME = '$sanction_plce'");
               
                //checking if the sanction code is available
                while($row = mysqli_fetch_assoc($view_query_place))
                {
                    $getcount = $row["COUPD"];

                }
                //sanction code seen
               if($getcount == '1')
               {
                 
//                 $querysanc = mysqli_query($con,"UPDATE `r_sanction_details` SET `SancDetails_CODE`='$sanction_code',`SancDetails_NAME`='$sanction_name',`SancDetails_TIMEVAL`='$sanction_time',WHERE `SancDetails_CODE`='$sanction_code'");

               }
               else
               {
                
                $queryplace = mysqli_prepare($con, "INSERT INTO `r_designated_offices_details`(`DesOffDetails_CODE`, `DesOffDetails_NAME`) VALUES (?,?)");
                mysqli_stmt_bind_param($queryplace,'ss',$sanction_plce,$sanction_plce);
                mysqli_stmt_execute($queryplace);
              
               }

               $arr = array(
                'place'  => $sanction_plce
               );
               array_push( $container_arr, (array)$arr );


           }
            echo json_encode($container_arr);
//          echo 'okay';
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
