<?php 
include('../config/connection.php');
$username = $_POST["login_name"];
$password = $_POST["login_pass"];
$query = "call Login_User('$username','$password')";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
	echo "1";
}else{
	echo "0";
}

?>
 