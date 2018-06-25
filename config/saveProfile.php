<?php

include('query.php');
include ('connection.php');

    session_start();
    $userID = $_SESSION['logged_user']['id'];
    $userName = $_POST['username'];
    $userPassword = $_POST['password'];
    $userPrevPassword = $_POST['prevpassword'];
    $userNamePrev = $_SESSION['logged_user']['username'];
                $filename = $userName.'.'.'png';
                $url = '../Avatar/'.$filename;

if(isset($_POST["OSAS_Save"])){

$checkPass = mysqli_query($con,"SELECT *
FROM osas.r_users
WHERE Users_ID = '$userID'
AND AES_DECRYPT(Users_PASSWORD, Password('OSASMIS')) ='$userPrevPassword'
AND Users_DISPLAY_STAT = 'Active' ");

    if(mysqli_num_rows($checkPass) ==1){

//             if(isset($_FILES['file'])){
//
//                $path = $_FILES['file']['name'];
//
//            // Check for errors
//            if($_FILES['file']['error'] > 0){
//                die('EWU');
//            }
//
//            // Check filesize
//            if($_FILES['file']['size'] > 10485760){
//                die('ES');
//            }
//
//            // Check if the file exists
//            if(file_exists($url)){
//                    chmod($url,0755); //Change the file permissions if allowed
//                    unlink($url); //remove the file
//            }
//
//            // Upload file
//            if(!move_uploaded_file($_FILES['file']['tmp_name'], '../Avatar/' . $filename)){
//                die('CD');
//            }
//
//            } else{
//                         if($userNamePrev !=$userName ){
//                   if(copy('../Avatar/'.$userNamePrev.'.'.'png','../Avatar/'.$filename)){
//
//                    chmod('../Avatar/'.$userNamePrev.'.'.'png',0755); //Change the file permissions if allowed
//                    unlink('../Avatar/'.$userNamePrev.'.'.'png'); //remove the file
//            }
//
//                }
//             }

            if(mysqli_query($con,"UPDATE r_users SET Users_USERNAME = '$userName',Users_PASSWORD = AES_Encrypt('$userPassword',PASSWORD('OSASMIS')) where Users_ID = $userID")or die()){
                $_SESSION['logged_user']['username']= $userName;
        }



    }else die('ERR');

}




?>
