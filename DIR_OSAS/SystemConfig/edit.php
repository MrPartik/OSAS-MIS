
<?php
include ("../../config/connection.php");

if(isset($_POST['insertt'])){
$name = $_POST['name'];
$prop = $_POST['prop'];

mysqli_query($con,"update r_system_config set SysConfig_PROPERTIES ='$prop' where SysConfig_NAME = '$name' ");
}


?>
