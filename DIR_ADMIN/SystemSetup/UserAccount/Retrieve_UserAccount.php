<?php 
include ('../../../config/connection.php'); 

	if(isset($_POST['_username']) )
	{
		$username = $_POST['_username'];
        mysqli_query($con,"UPDATE r_users SET Users_DISPLAY_STAT = 'Active', Users_DATE_MOD = CURRENT_TIMESTAMP WHERE Users_USERNAME = '$username' "); 

	}
  

?>
