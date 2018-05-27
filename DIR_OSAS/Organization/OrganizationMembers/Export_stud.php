<?php
 if(!empty($_FILES["employee_file"]["name"]))
 {
    include('../../../config/connection.php');

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
                $studnum = mysqli_real_escape_string($con, $row[0]);
                $studlname = mysqli_real_escape_string($con, $row[1]);
                $studmname = mysqli_real_escape_string($con, $row[2]);
                $studfname = mysqli_real_escape_string($con, $row[3]);
                $studcourse = mysqli_real_escape_string($con, $row[4]);
                $studyrlevel = mysqli_real_escape_string($con, $row[5]);
                $studsection = mysqli_real_escape_string($con, $row[6]);
                $studgender = mysqli_real_escape_string($con, $row[7]);
                $studemail = mysqli_real_escape_string($con, $row[8]);
                $studcontact = mysqli_real_escape_string($con, $row[9]);
                $studbday = mysqli_real_escape_string($con, $row[10]);
                $studbplace = mysqli_real_escape_string($con, $row[11]);
                $studaddress = mysqli_real_escape_string($con, $row[12]);
                $studstatus = mysqli_real_escape_string($con, $row[13]);

               $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM r_stud_profile WHERE Stud_NO= '$studnum'");

                while($row = mysqli_fetch_assoc($view_query))
                {
                    $getcou = $row["COU"];

                }

               if($getcou == '1')
               {

                 $queryy = mysqli_query($con," UPDATE `r_stud_profile` SET `Stud_FNAME` = '$studfname',`Stud_MNAME` = '$studmname',`Stud_LNAME` = '$studlname',`Stud_COURSE` = '$studcourse',`Stud_YEAR_LEVEL` = '$studyrlevel',`Stud_SECTION` = '$studsection',`Stud_GENDER` = '$studgender',`Stud_EMAIL` = '$studemail',`Stud_MOBILE_NO` = '$studcontact',`Stud_BIRTH_DATE` = '$studbday',`Stud_BIRTH_PLACE` = '$studbplace',`Stud_CITY_ADDRESS` = '$studaddress',`Stud_STATUS` = '$studstatus' WHERE `r_stud_profile`.`Stud_NO` = '$studnum'");

               }
               else
               {

                $queryy = mysqli_prepare($con, "INSERT INTO r_stud_profile(Stud_NO, Stud_FNAME, Stud_MNAME, Stud_LNAME, Stud_COURSE, Stud_YEAR_LEVEL, Stud_SECTION, Stud_GENDER, Stud_EMAIL,Stud_MOBILE_NO,Stud_BIRTH_DATE,Stud_BIRTH_PLACE,Stud_CITY_ADDRESS,Stud_STATUS)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                mysqli_stmt_bind_param($queryy, 'ssssssssssssss',$studnum,$studfname,$studmname,$studlname,$studcourse,$studyrlevel,$studsection,$studgender,$studemail,$studcontact,$studbday,$studbplace,$studaddress,$studstatus);
                mysqli_stmt_execute($queryy);
               }

               $arr = array(
                'snum'  => $studnum
               );
               array_push(  $container_arr, (array)$arr );



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
