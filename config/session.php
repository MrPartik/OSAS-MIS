<?php
   include('connection.php');
   session_start(); 
   $user_check = $_SESSION['logged_in']; 
   $ses_sql = mysql_query("select * FROM r_users
WHERE Users_USERNAME = '$user_check'");
$num_rows = mysql_num_rows($ses_sql);
if(!isset($_SESSION['logged_in']))
{
    header('location: ../login.php');
}
?>
