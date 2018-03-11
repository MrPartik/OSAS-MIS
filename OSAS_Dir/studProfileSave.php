<?php 
include ('../config/connection.php'); 
if ($_POST['action']==="insertActive"){
$studno=$_POST['studno'];
$email=$_POST['emailadd'];
$contact=$_POST['contact'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$course=$_POST['course'];
$section=$_POST['section']; 
$gender=$_POST['gender']; 
$bday=$_POST['bdate']; 
$bplace=$_POST['bplace'];  
$status=$_POST['status'];
$address=$_POST['address'];
mysqli_query($con," Call Insert_StudProfile(
'$studno'
,'$fname'
,'$mname'
,'$lname'
,'$course'
,'$section'
,'$gender'
,'$email'
,'$contact'
,'$bday'
,'$bplace'
,'$address'
,'$status')")or die(mysql_error());  
}
   else if ($_POST['action']==="updateActive"){ 
    $studno=$_POST['studno'];
    $email=$_POST['emailadd'];
    $contact=$_POST['contact'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $course=$_POST['course'];
    $section=$_POST['section']; 
    $gender=$_POST['gender']; 
    $bday=$_POST['bdate']; 
    $bplace=$_POST['bplace'];  
    $status=$_POST['status'];
    $address=$_POST['address'];
    $studID = $_POST['studID'];
    mysqli_query($con," Call Update_StudProfile(
    $studID
    ,'$studno'
    ,'$fname'
    ,'$mname'
    ,'$lname'
    ,'$course'
    ,'$section'
    ,'$gender'
    ,'$email'
    ,'$contact'
    ,'$bday'
    ,'$bplace'
    ,'$address'
    ,'$status')")or die(mysql_error());  
    } 
    else if ($_POST['action']==="ArchiveActive"){  
    $studID = $_POST['studID'];
    mysqli_query($con,"Call Archive_StudProfile(
    $studID)")or die(mysql_error());  
    }  
?>
