<?php

$servername = "192.168.43.152";
$username = "root";
$password = "";
$dbname = "osas";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $username = "2015-00015-CM-0";
  $password = "keith";
  $query = "call Login_User('$username','$password')"; 
  $result = mysqli_query($con,$query);
                                $num_row = mysqli_num_rows($result); 
                                $row = mysqli_fetch_assoc($result);  
                               
                  if( $num_row > 0 ) {
echo 1;
}
else
echo "false";
	
?>