<?php 
include('../config/connection.php');
$sancID = $_POST["SancID"];
$sancCode = $_POST["SancCode"];
$sancName = $_POST["SancName"];
$sancDesc = $_POST["SancDesc"];
$sancTime = $_POST["SancTime"];
$query = "update r_sanction_details SET SancDetails_CODE='$sancCode', SancDetails_NAME ='$sancName', SancDetails_DESC='$sancDesc', SancDetails_TIMEVAL =$sancTime, SancDetails_DATE_MOD = CURRENT_TIMESTAMP WHERE SancDetails_ID =$sancID";
$result = mysqli_query($con,$query);

echo mysqli_affected_rows($con);

?>
 