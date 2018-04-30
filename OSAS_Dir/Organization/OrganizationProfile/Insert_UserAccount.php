<?php
	
   
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
        include ('../../connection.php'); 

        if(isset($_POST['_reference']) )
        {
            $ref = $_POST['_reference'];
            mysqli_query($connection,"call Insert_Users('$ref','$ref','Organization','$ref') "); 

        }
  
        
    }
    else
    {
        
        include('../Retrict.php');
        
    }

?>


