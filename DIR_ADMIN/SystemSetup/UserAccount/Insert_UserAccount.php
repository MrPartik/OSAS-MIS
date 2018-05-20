<?php 
include ('../../../config/connection.php'); 

	if(isset($_POST['_username']) )
	{
		$username = $_POST['_username'];
		$password = $_POST['_password'];
		$role = $_POST['_role'];
		$ref = $_POST['_reference'];
        if($ref == 'default')
            mysqli_query($con,"call Insert_Users('$username','','$role','$password') "); 
        else
            mysqli_query($con,"call Insert_Users('$username','$ref','$role','$password') "); 

	}
  

?>
