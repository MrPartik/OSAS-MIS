<?php

include('../config/query.php');
include ('../config/connection.php');

if(isset($_POST["insertDoc"])){

            $countquery  = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(`ArchDocuments_ID`)+1 countt FROM r_archiving_documents"));
            $count = $countquery['countt'];
            $docuName = $_POST["docuName"];
            $docuDesc = $_POST["docuDesc"];
            $filename = "   ";




            if(isset($_FILES['file'])){
                $path = $_FILES['file']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
            $filename = 'Document-'.$current_acadyear.'-'.$docuName.'.'.$ext;
            $url = '../Documents/'.$filename;

            // Check for errors
            if($_FILES['file']['error'] > 0){
                die('EWU');
            }

            // Check filesize
            if($_FILES['file']['size'] > 10485760){
                die('ES');
            }

            // Check if the file exists
            if(file_exists('../Documents/' . $_FILES['file']['name'])){
                die('AE');
            }

            // Upload file
            if(!move_uploaded_file($_FILES['file']['tmp_name'], '../Documents/' . $filename)){
                die('CD');
            }

            mysqli_query($con,"INSERT INTO `r_archiving_documents` ( `ArchDocuments_ORDER_NO`, `ArchDocuments_NAME`, `ArchDocuments_DESC`, `ArchDocuments_FILE_PATH`) VALUES ('$current_acadyear _ $count','$docuName','$docuDesc','$filename')")or die('Error executing query');
        }
}
?>
