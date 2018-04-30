<?php 
include('../config/connection.php');
$sancCode = $_POST["SancCode"];
$sancName = $_POST["SancName"];
$sancDesc = $_POST["SancDesc"];
$sancTime = $_POST["SancTime"];
$query = "call Insert_SanctionDetails('$sancCode','$sancName','$sancDesc',$sancTime)";
$result = mysqli_query($con,$query);

echo mysqli_affected_rows($con);

?>
 