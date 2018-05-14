<?php 
include ('../../connection.php'); 

	if(isset($_POST['_username']) )
	{
		$username = $_POST['_username'];
        mysqli_query($connection,"UPDATE r_users SET Users_DISPLAY_STAT = 'Active', Users_DATE_MOD = CURRENT_TIMESTAMP WHERE Users_USERNAME = '$username' "); 

	}
  

?>
