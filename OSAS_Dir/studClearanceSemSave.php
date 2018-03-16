<?php
include('../config/query.php');
include ('../config/connection.php');
if(isset($_POST['insertSig']))
{
    $code = $_POST['Code'];
    $name=$_POST['Name'];
     $desc=$_POST['SDesc'];
   mysqli_query($con,"call Insert_Signatories('$code','$name','$desc')");
}
?>
