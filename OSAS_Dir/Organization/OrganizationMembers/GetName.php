<?php
	
	include('../../connection.php');
    $compcode = $_GET['_code'];
    $stat = $_GET['_stat'];
    

     echo json_encode(
          array("list" => $list)
     );
?>
