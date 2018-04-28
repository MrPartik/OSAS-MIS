<?php 
include('../config/connection.php');

if ($con->connect_error) {
 die("Connection failed: " . $con->connect_error);
} 

$sql = "SELECT SancDetails_ID id, SancDetails_CODE Code,SancDetails_NAME Name,SancDetails_DESC Descs, SancDetails_TIMEVAL timeval FROM  r_sanction_details";
$result = $con->query($sql);

if ($result->num_rows >0) {
 // output data of each row
 while($row[] = $result->fetch_assoc()) {
 
 $tem = $row;
 
 $json = json_encode($tem);
 
 
 }
 
} else {
 echo "0 results";
}
 echo $json;
$con->close();
?>
 