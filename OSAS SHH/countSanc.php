<?php 
include('../config/connection.php'); 


if ($con->connect_error) {
 die("Connection failed: " . $con->connect_error);
} 
 
$sql="SELECT (SELECT concat('Number of Students who has sanctions: ',Count(B.AssSancStudStudent_ID)) 
                                    FROM r_stud_profile A
                                    INNER JOIN  t_assign_stud_saction B ON
                                        A.Stud_NO = B.AssSancStudStudent_STUD_NO
                                    INNER JOIN r_sanction_details C ON
                                        C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE
                                    INNER JOIN r_designated_offices_details D ON
                                        D.DesOffDetails_CODE = B.AssSancStudStudent_DesOffDetails_CODE 
                                    WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
                                    AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
                                    AND C.SancDetails_DISPLAY_STAT='ACTIVE'
                                    AND D.DesOffDetails_DISPLAY_STAT='ACTIVE' 
                                    AND B.AssSancStudStudent_IS_FINISH<>'FINISHED')  stud
     , (SELECT concat('Number of sanction details: ',Count(S.SancDetails_CODE))
       FROM r_sanction_details S WHERE s.SancDetails_DISPLAY_STAT='Active') sanc"; 

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
 
 