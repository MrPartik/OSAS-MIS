<?php
	
	include('../../../config/connection.php');
        
		$getyear = mysqli_query($con,'select * from `r_batch_details` order by Batch_ID desc ');
        $getid = $_GET['_code'];
		$option = '';
		$code = '';
		$i = 0 ;
		while($getrow = mysqli_fetch_assoc($getyear))
		{
			$year = $getrow["Batch_YEAR"];
            if($year == $getid)
                $option  = $option . '<option value="'.$year.'" selected>'.$year.'</option>';
            else
                $option  = $option . '<option value="'.$year.'">'.$year.'</option>';
		}	
		$view_query = mysqli_query($con,"select CONCAT('COU',RIGHT(100000+count(Course_ID)+1,5)) CODE from `r_courses`");
		while($row = mysqli_fetch_assoc($view_query))
		{
			$code = $row["CODE"];
		}
		
		echo json_encode(
			  array("code" => $code, 
			  "option" => $option)
		 );

?>
