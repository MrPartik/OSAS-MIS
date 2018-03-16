<?php

    include('../../../config/connection.php');     
    echo $filename=$_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"] > 0)
    {

        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {

        //It wiil insert a row to our subject table from our csv file`
            $query = mysqli_query($con,"INSERT INTO excel (studname,studnum) VALUES ('$emapData[1]','$emapData[2]') ");

        }
        fclose($file);
        //throws a message if data successfully imported to mysql database from excel file
        echo "<script type=\"text/javascript\">
        alert(\"CSV File has been successfully Imported.\");
        window.location = \"index.php\"
        </script>";
        //close of connection
        mysql_close($conn); 
    }
 
?>
