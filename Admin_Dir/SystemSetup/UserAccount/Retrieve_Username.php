<?php 

include('../../../config/connection.php');

 
    $username = $_GET['_username'];

    $view_query = mysqli_query($con," SELECT COUNT(*) AS COU FROM r_users WHERE Users_USERNAME = '$username'  ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];

    }

    echo $cou;

?>
