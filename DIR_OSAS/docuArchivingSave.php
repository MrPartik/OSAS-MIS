<?php

include('../config/query.php');
include ('../config/connection.php');

if(isset($_POST['checkfilee'])){

    $docsQuery = mysqli_query($con,"SELECT `ArchDocuments_ID`, `ArchDocuments_ORDER_NO`, `ArchDocuments_NAME`, `ArchDocuments_DESC`, `ArchDocuments_FILE_PATH`, `ArchDocuments_STATUS`, `ArchDocuments_DATE_ADD`, `ArchDocuments_DATE_MOD`, `ArchDocuments_DISPLAY_STAT`, DATEDIFF(CURRENT_DATE,`ArchDocuments_DATE_ADD`) disposal FROM `r_archiving_documents`");
    while($docs = mysqli_fetch_assoc($docsQuery))
    {

                    foreach(glob('../Documents/*') as $file)
                            {
                                if($file!= ('../Documents/'.$docs['ArchDocuments_FILE_PATH']))
                                {
                                     unlink($file);
                                }
                                if($docs['ArchDocuments_FILE_PATH']> $disposalDays){
                                     unlink('../Documents/'.$docs['ArchDocuments_FILE_PATH']);
                                        mysqli_query($con,"update r_archiving_documents set ArchDocuments_DISPLAY_STAT = 'Inactive' where ArchDocuments_ID =".$docs['ArchDocuments_ID']);
                                }

                            }
    }
}






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
