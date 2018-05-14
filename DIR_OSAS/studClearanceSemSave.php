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
if(isset($_POST['confilictInsert']))
{
  $studno = trim($_POST['studno']);
    $acady=$_POST['acady'];
    $sem=$_POST['sem'];
    $sigcode=$_POST['sigcode'];

    mysqli_query($con,"UPDATE `t_assign_student_clearance` SET 
    `AssStudClearance_DISPLAY_STAT`='Inactive' 
    WHERE WHERE `AssStudClearance_STUD_NO`='$studno'
    AND `AssStudClearance_BATCH` ='$acady'
    AND `AssStudClearance_SEMESTER` ='$sem'");

    $cond_query = mysqli_query($con,"SELECT *
    FROM `t_assign_student_clearance` 
    WHERE `AssStudClearance_STUD_NO`='$studno'
    AND `AssStudClearance_BATCH` ='$acady'
    AND `AssStudClearance_SEMESTER` ='$sem'
    AND `AssStudClearance_SIGNATORIES_CODE` ='$sigcode'");

    $noRow = mysqli_num_rows($cond_query);
    $fetchRow = mysqli_fetch_assoc($cond_query);
    $id = $fetchRow["AssStudClearance_ID"];


    if($noRow==0){
      mysqli_query($con,"call Insert_AssignConfilicts_SemClearance('$studno','$acady','$sem','$sigcode')");
    }else{
      mysqli_query($con,"call Active_AssignConfilicts_SemClearance('$id')");
    }

}
if(isset($_POST['preinst'])){
  
  $studno = trim($_POST['studno']);
  $acady=$_POST['acady'];
  $sem=$_POST['sem']; 

  mysqli_query($con,"UPDATE `t_assign_student_clearance` SET 
  `AssStudClearance_DISPLAY_STAT`='Inactive' 
  WHERE  `AssStudClearance_STUD_NO`='$studno'
  AND `AssStudClearance_BATCH` ='$acady'
  AND `AssStudClearance_SEMESTER` ='$sem'");
  
}

if(isset($_POST['fillSig'])){

    $studno = trim($_POST['studno']);
    $acady=$_POST['acady'];
    $sem=$_POST['sem']; 
    $container_arr = array();
    $cond_query = mysqli_query($con,"SELECT *
    FROM `t_assign_student_clearance` 
    WHERE `AssStudClearance_STUD_NO`='$studno'
    AND `AssStudClearance_BATCH` ='$acady'
    AND `AssStudClearance_SEMESTER` ='$sem'
    AND `AssStudClearance_DISPLAY_STAT`='Active'");

    
while($fetchRow = mysqli_fetch_assoc($cond_query)){

  $sigcode = $fetchRow["AssStudClearance_SIGNATORIES_CODE"];
  $arr = array( 'sigcode' => $sigcode );
  array_push(  $container_arr, (array)$arr );
}
  
  echo json_encode($container_arr);
}
?>
