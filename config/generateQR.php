<?php 
header("Content-Type: image/png");
require "../ASSETS/vendor/autoload.php";

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;

$qrcode = new QrCode($_GET['text']);  
$qrcode->setLogoPath('../ASSETS/images/osasmis.png');
$qrcode->setLogoWidth(100); 
$qrcode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
echo $qrcode->writeString();
die();
