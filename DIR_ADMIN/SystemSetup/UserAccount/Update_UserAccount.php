<?php 
include ('../../../config/connection.php'); 

	if(isset($_POST['_username']) )
	{
		$username = $_POST['_username'];
        $olduname = $_POST['_olduname'];
		$password = $_POST['_password'];
		$role = $_POST['_role'];
		$ref = $_POST['_reference'];
        if($ref == 'default')
            mysqli_query($con,"UPDATE `r_users` SET Users_USERNAME =  '$username', Users_REFERENCED = '', Users_ROLES ='Administrator' ,AES_Encrypt('$password',PASSWORD('OSASMIS') )
            WHERE Users_USERNAME = '$olduname' "); 
        else
            mysqli_query($con,"UPDATE `r_users` SET Users_USERNAME =  '$username', Users_REFERENCED = '$ref', Users_ROLES ='$role' ,AES_Encrypt('$password',PASSWORD('OSASMIS') )
            WHERE Users_USERNAME = '$olduname' "); 

	}
  

?>
