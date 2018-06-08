<?php
    require('../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{

    // Page header

    function Header(){
      //Header Logo
    // $this->Image('../ASSETS/images/PUPLogo.png',10,6,18);
      //Header
      $this->SetFont('Times','B',10);
      $this->Cell(0,0,'Republic of the Philippines',0,0,'C');
      $this->Ln(5);

      $this->SetFont('Times','B',12);
      $this->Cell(0,0,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,0,'C');
      $this->Ln(5);

      $this->SetFont('Times','',10);
      $this->Cell(0,0,'DON FABIAN COMMONWEALTH, QUEZON CITY BRANCH',0,0,'C');
      $this->Ln(3);

      $this->SetFont('Times','',28);
      $this->Cell(0,0,'________________________________________',0,0,'');
      $this->Ln(7);

      $this->SetFont('Times','',8);
      $this->Cell(0,0,'PUPQC CLEARANCE FORM Rvsd. March 2018 ',0,0,'R');
      $this->Ln(10);

      $this->SetFont('Arial','B',15);
      $this->Cell(0,10,'CERTIFICATE OF COMPLETION',0,0,'C');
      $this->Ln(17);


}

// Page footer
//function Footer(){
//  $this->SetY(-15);
//  $this->SetFont('Times','I',8);
//  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
//}


  function headerTable(){

    include('../config/connection.php');
    include('../config/query.php');
           $StudentNo = "N/A";

            if(isset($_GET['studno'])){
            $StudentNo = $_GET['studno'];
            }

      $infoProfile = mysqli_fetch_array(mysqli_query($con,"SELECT upper(CONCAT(R_SP.Stud_LNAME,', ',R_SP.Stud_FNAME,' ',COALESCE(R_SP.Stud_MNAME,''))) AS FullName, T_ASS.AssSancStudStudent_TO_BE_DONE, T_ASS.AssSancStudStudent_CONSUMED_HOURS, R_SP.Stud_NO, T_ASS.AssSancStudStudent_REMARKS, T_ASS.AssSancStudStudent_IS_FINISH, T_ASS.AssSancStudStudent_DATE_ADD, R_SD.SancDetails_NAME,R_SP.Stud_COURSE, R_SP.Stud_YEAR_LEVEL, R_SP.Stud_SECTION, R_DOD.DesOffDetails_NAME,R_SD.SancDetails_CODE FROM t_assign_stud_saction T_ASS
INNER JOIN r_sanction_details R_SD ON T_ASS.AssSancStudStudent_SancDetails_CODE = R_SD.SancDetails_CODE
INNER JOIN r_designated_offices_details R_DOD ON T_ASS.AssSancStudStudent_DesOffDetails_CODE = R_DOD.DesOffDetails_CODE
INNER JOIN r_stud_profile R_SP ON R_SP.Stud_NO = T_ASS.AssSancStudStudent_STUD_NO AND R_SP.Stud_NO = '$StudentNo' "));


        $this->SetFont('Arial','',10);
        $this->MultiCell(0,8,'              This is to certify that '.$infoProfile['FullName'].' ('.strtoupper( $infoProfile['Stud_NO']).') of '.strtoupper($infoProfile['Stud_COURSE'] ).' '.$infoProfile['Stud_YEAR_LEVEL'] .' - '. $infoProfile['Stud_SECTION'] .' has been cleared of  all accountabilities and obligations from this University'.' ',0,1,'');
        $this->Ln(12);

        $this->SetFont('Arial','B',10);
        $this->Cell(0,0,'THE ABOVE-NAMED STUDENT IS CLEARED OF ALL MONEY AND PROPERTY RESPONSIBILITY IN MY OFFICE.',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Arial','B',9);
        $this->SetFillColor(220,220,220);
        $this->Cell(195,10,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES QUEZON CITY BRANCH ACADEMIC AND NON-ACADEMIC OFFICES',1,0,'C',TRUE);
        $this->Ln(10);

        $count=1;
        $this->SetFont('Arial','',8);
        $colY = $this->GetY();

      $this->Ln(5);
        $this->SetFont('Arial','B',10);
  $this->Cell(0,9,'NOTE:',0,0,'L');
  $this->Ln(4);
      $this->SetFont('Arial','',10);
  $this->Cell(0,9,'    *   This clearance is valid only for five (5) months.',0,0,'L');
  $this->Ln(4);
  $this->Cell(0,9,'    *   Bring your previous Registration Card and this clearance upon cliaming your present Registration Card.',0,0,'L');
  $this->Ln(4);
  $this->Cell(0,9,'    *   Please make sure that the QR Code in the lower right side is not tampered.',0,0,'L');
  $this->Ln(20);

      $this->SetFont('Arial','I',8);
     $this->Cell(0,0,(new datetime())->format('D M d, Y h:i A').' This is system generated form.',0,0,'L');
     $this->Cell(0,0,'Student`s Copy',0,0,'R');
      $this->Ln(3);
    $QRY = $this->GetY();

      $this->SetFont('Arial','',10);
      $this->Cell(0,0,'-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'C');
          $this->Ln(3);
            $this->SetFont('Arial','I',8);
     $this->Cell(0,0,(new datetime())->format('D M d, Y h:i A').' This is system generated form.',0,0,'L');
     $this->Cell(0,0,'University`s Copy',0,0,'R');
      $this->ln(15);


      $this->SetFont('Arial','B',9);
        $this->SetFillColor(220,220,220);
        $this->Cell(195,10,'VERIFICATION AND IDENTIFICATION ',1,0,'C',TRUE);
        $this->Ln(10);

        $this->SetFont('Arial','B',8);
        $this->Cell(50,7,'Student Number:  ',1,0,'R');
        $this->Cell(145,7,strtoupper($infoProfile['Stud_NO']),1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Full Name:  ',1,0,'R');
        $this->Cell(145,7,$infoProfile['FullName'],1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Course/ Semester/ Acad. Year:  ',1,0,'R');
        $this->Cell(145,7,$infoProfile['Stud_COURSE'] .' '.$infoProfile['Stud_YEAR_LEVEL'] .' - '. $infoProfile['Stud_SECTION'],1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Received By, w/ Signature  ',1,0,'R');
        $this->Cell(145,7,'',1,0,'L');
      $this->Ln(7);


  }
}

$pgurl = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

function absurl($url) {
 global $pgurl;
 if(strpos($url,'://')) return $url;
 if(substr($url,0,2)=='//') return 'http:'.$url;
 if($url[0]=='/') return parse_url($pgurl,PHP_URL_SCHEME).'://'.parse_url($pgurl,PHP_URL_HOST).$url;
 if(strpos($pgurl,'/',9)===false) $pgurl .= '/';
 return substr($pgurl,0,strrpos($pgurl,'/')+1).$url;
}

function nodots($path) {
 $arr1 = explode('/',$path);
 $arr2 = array();
 foreach($arr1 as $seg) {
  switch($seg) {
   case '.':
    break;
   case '..':
    array_pop($arr2);
    break;
   case '...':
    array_pop($arr2); array_pop($arr2);
    break;
   case '....':
    array_pop($arr2); array_pop($arr2); array_pop($arr2);
    break;
   case '.....':
    array_pop($arr2); array_pop($arr2); array_pop($arr2); array_pop($arr2);
    break;
   default:
    $arr2[] = $seg;
  }
 }
 return implode('/',$arr2);
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->SetAuthor('John Patrick Loyola');
$pdf->headerTable();
$pdf->Output();
?>
