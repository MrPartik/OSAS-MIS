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

      $infoProfile = mysqli_fetch_array(mysqli_query($con,"SELECT *,upper(CONCAT(RSP.Stud_LNAME,', ',RSP.Stud_FNAME,' ',COALESCE(RSP.Stud_MNAME,''))) AS FullName  FROM t_clearance_generated_code CGC
INNER JOIN r_stud_profile RSP on CGC.ClearanceGenCode_STUD_NO = RSP.Stud_NO
WHERE ClearanceGenCode_STUD_NO = '$StudentNo'
AND ClearanceGenCode_ACADEMIC_YEAR = (SELECT ActiveAcadYear_Batch_YEAR FROM active_academic_year WHERE ActiveAcadYear_IS_ACTIVE = 1 )
AND ClearanceGenCode_SEMESTER = (SELECT ActiveSemester_SEMESTRAL_NAME FROM active_semester WHERE ActiveSemester_IS_ACTIVE = 1) "));


        $this->SetFont('Arial','',10);
        $this->MultiCell(0,8,'              This is to certify that '.$infoProfile['FullName'].' ('.strtoupper( $infoProfile['ClearanceGenCode_STUD_NO']).') of '.strtoupper($infoProfile['Stud_COURSE'] ).' '.$infoProfile['Stud_YEAR_LEVEL'] .' - '. $infoProfile['Stud_SECTION'] .' has been cleared of  all accountabilities and obligations from this University for the '.strtoupper($infoProfile['ClearanceGenCode_SEMESTER'] ).', school year '.$infoProfile['ClearanceGenCode_ACADEMIC_YEAR'].'.'.' ',0,1,'');
        $this->Ln(12);

        $this->SetFont('Arial','B',10);
        $this->Cell(0,0,'THE ABOVE-NAMED STUDENT IS CLEARED OF ALL MONEY AND PROPERTY RESPONSIBILITY IN MY OFFICE.',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Arial','',9);
        $this->Cell(0,0,'(To be signed by the duly authorized representative of the respective offices.)',0,0,'C');
        $this->Ln(9);

        $this->SetFont('Arial','B',9);
        $this->SetFillColor(220,220,220);
        $this->Cell(195,10,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES QUEZON CITY BRANCH ACADEMIC AND NON-ACADEMIC OFFICES',1,0,'C',TRUE);
        $this->Ln(10);

        $count=1;
        $this->SetFont('Arial','',8);
        $signatoriesQuery = mysqli_query($con,"SELECT * FROM `r_clearance_signatories` WHERE `ClearSignatories_TYPE` = 'SEMESTRAL' AND `ClearSignatories_DISPLAY_STAT` = 'Active'");

        $colY = $this->GetY();
        $totSig = mysqli_num_rows($signatoriesQuery);
        while($signatories=mysqli_fetch_assoc($signatoriesQuery)){
            if($totSig==5){
                $this->Cell(195,7,'   '.$signatories['ClearSignatories_NAME'].' - '.$signatories['ClearSignatories_DESC'],1,10,'L');
                $resetY = $this->GetY();
            }else {
            if($count<=5)
            {
                $this->Cell(97.5,7,'   '.$signatories['ClearSignatories_NAME'].' - '.$signatories['ClearSignatories_DESC'],1,10,'L');
                $resetY = $this->GetY();
            }else{
                $this->SetY($colY);
                $this->SetX(107.5);
                $this->Cell(97.5,7,'   '.$signatories['ClearSignatories_NAME'].' - '.$signatories['ClearSignatories_DESC'],1,10,'L');
                $colY = $this->GetY();
            }
            $count++;
            }

        }

      $this->Ln(5);
      $this->setY($resetY+5);
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
    $this->Image('http://'.$_SERVER['HTTP_HOST'].'/OSAS%20MIS/config/generateQR.php?text='.$infoProfile['ClearanceGenCode_COD_VALUE'].'#.png',182,$QRY-35,25);
      $this->SetFont('Arial','',10);
      $this->Cell(0,0,'-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'C');
          $this->Ln(3);
            $this->SetFont('Arial','I',8);
     $this->Cell(0,0,(new datetime())->format('D M d, Y h:i A').' This is system generated form.',0,0,'L');
     $this->Cell(0,0,'University`s Copy',0,0,'R');
      $this->ln(15);
      $this->Image('http://'.$_SERVER['HTTP_HOST'].'/OSAS%20MIS/config/generateQR.php?text='.$infoProfile['ClearanceGenCode_COD_VALUE'].'#.png',177.5,$QRY+43.5,28);
      $this->SetFont('Arial','B',15);
      $this->cell(0,0,$infoProfile['ClearanceGenCode_COD_VALUE'],0,0,"C");
         $this->Ln(15);

      $this->SetFont('Arial','B',9);
        $this->SetFillColor(220,220,220);
        $this->Cell(195,10,'VERIFICATION AND IDENTIFICATION ',1,0,'C',TRUE);
        $this->Ln(10);

        $this->SetFont('Arial','B',8);
        $this->Cell(50,7,'Student Number:  ',1,0,'R');
        $this->Cell(117,7,strtoupper($infoProfile['ClearanceGenCode_STUD_NO']),1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Full Name:  ',1,0,'R');
        $this->Cell(117,7,$infoProfile['FullName'],1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Course/ Semester/ Acad. Year:  ',1,0,'R');
        $this->Cell(117,7,$infoProfile['Stud_COURSE'] .' '.$infoProfile['Stud_YEAR_LEVEL'] .' - '. $infoProfile['Stud_SECTION'].'/ '.strtoupper($infoProfile['ClearanceGenCode_SEMESTER']).'/ '.$infoProfile['ClearanceGenCode_ACADEMIC_YEAR'] ,1,0,'L');
      $this->Ln(7);
        $this->Cell(50,7,'Received By, w/ Signature  ',1,0,'R');
        $this->Cell(117,7,'',1,0,'L');
      $this->Ln(7);


  }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','Letter',0);
$pdf->SetAuthor('John Patrick Loyola');
$pdf->headerTable();
$pdf->Output();
?>
