<?php
include('query.php');

$sqlquery =mysqli_query($con, "SELECT * FROM `r_stud_profile`");
$yearAdmission  = substr($current_acadyear,0,4);

if(date('m')>= 06){
    while($studQuery = mysqli_fetch_assoc($sqlquery)){
        $studNo = $studQuery['Stud_NO'];
        $studAdmitted = substr($studQuery['Stud_NO'],0,4);
        $countYear = $yearAdmission-$studAdmitted;

        mysqli_query($con,"update r_stud_profile set Stud_YEAR_LEVEL = $countYear where Stud_NO = '$studNo' ");

    }
}
    else{
          while($studQuery = mysqli_fetch_assoc($sqlquery)){
        $studNo = $studQuery['Stud_NO'];
        $studAdmitted = substr($studQuery['Stud_NO'],0,4);
        $countYear = $yearAdmission-$studAdmitted+1;
        mysqli_query($con,"update r_stud_profile set Stud_YEAR_LEVEL = $countYear where Stud_NO = '$studNo' ");


    }
}

?>
