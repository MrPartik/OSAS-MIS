<?php 
header("Content-Type: image/png");
require "../ASSETS/vendor/autoload.php";

use Endroid\QrCode\QrCode;

$qrcode = new QrCode($_GET['text']);  
$qrcode->setLogoPath('../ASSETS/images/osasmis.png');
$qrcode->setForegroundColor(['r' => 20, 'g' => 20, 'b' => 20, 'a' => 0]);
$qrcode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
$qrcode->setLogoWidth(100); 
echo $qrcode->writeString();
die();