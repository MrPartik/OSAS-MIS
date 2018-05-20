<?php 
include ('../../../config/connection.php'); 

	if(isset($_POST['_username']) )
	{
		$username = $_POST['_username'];
        $view_query = mysqli_query($con,"SELECT * from r_users where Users_USERNAME = '$username' ");

        while($row = mysqli_fetch_assoc($view_query))
        {
            $uname = $row["Users_USERNAME"];
            $ref = $row["Users_REFERENCED"];
            $role = $row["Users_ROLES"];
        }

        echo json_encode(
              array("uname" => $uname,"ref" => $ref, "role" => $role)
        );

		
    
	}
  

?>
