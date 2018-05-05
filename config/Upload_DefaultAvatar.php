<?php
if(isset($_FILES["file"]["type"]))
{
$username = $_GET['Username'];   

$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 100000000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
//if (file_exists("Avatar/" . $_FILES["file"]["name"])) {
//if (file_exists("Avatar/" . $username.".png") )  {
//echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
//
//}
//else
//{
$sourcePath =  "../Avatar/Default-Organization.png"; // Storing source path of the file in a variable
$targetPath =  "../Avatar/".$username.".png"; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
    echo $username;
echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
//}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}
?>