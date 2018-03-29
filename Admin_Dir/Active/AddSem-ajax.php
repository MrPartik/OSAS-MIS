<?php
	
	include('../../config/connection.php');
	if(isset($_POST['_code']) )
	{
		$code = $_POST['_code'];

        $year = '0';
        $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU FROM active_semester  WHERE ActiveSemester_SEMESTRAL_NAME = '$code' ") ;
        while($row = mysqli_fetch_assoc($view_query))
        {
            $year = $row["COU"];

        }

        $query = mysqli_query($con,"UPDATE `active_semester` SET ActiveSemester_IS_ACTIVE = '0' ");

        
        if($year == '0')
            $query = mysqli_query($con,"INSERT INTO `active_semester` (ActiveSemester_SEMESTRAL_NAME,ActiveSemester_IS_ACTIVE) VALUES ('$code',1) ");
        else
            $query = mysqli_query($con,"UPDATE `active_semester` SET ActiveSemester_IS_ACTIVE = '1' WHERE ActiveSemester_SEMESTRAL_NAME = '$code' ");
            

	}

?>
