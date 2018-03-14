<?php 
include('con.php');
$username = $_POST['username'];
$password = $_POST['password'];
$query = "call Login_User('$username','$password')";

?>
 