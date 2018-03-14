<?php 
include('connection.php');
$username = $_POST["username"];
$password = $_POST["password"];
$query = "call Login_User('$username','$password')";
$result = mysqli_query($con,$query);
if(msyqli_num_rows($result)>0){
	echo "login success";
}else{
	echo "login not success";
}

?>
 