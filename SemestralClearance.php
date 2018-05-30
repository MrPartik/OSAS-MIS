<?php
require('ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
function Header(){
  
  //Header Logo
 $this->Image('ASSETS/images/PUPLogo.png',10,6,18);
 // $this->Image('deped.png',162,9,22); 
  //Header
  $this->SetFont('Times','',10);
  $this->Cell(0,3,'                      Republic of the Philippines',0,0,'C');
  $this->Ln(4);

  $this->SetFont('Times','',10);
  $this->Cell(0,3,'                      POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,0,'');
  $this->Ln(4);

  $this->SetFont('Times','',10);
  $this->Cell(0,3,'                      QUEZON CITY BRANCH',0,0,'');
  $this->Ln(3);

  $this->SetFont('Times','B',28);
  $this->Cell(0,0,'_______________________________________',0,0,'');  
  $this->Ln(7);

  $this->SetFont('Times','',8);
  $this->Cell(0,0,'PUPQC CLEARANCE FORM Rvsd. March 2018 ',0,0,'R');
  $this->Ln(3);

  $this->SetFont('Arial','B',10);
  $this->Cell(0,10,'CLEARANCE',0,0,'C');
  $this->Ln(11);
}

// Page footer
function Footer(){
  $this->SetY(-15);
  $this->SetFont('Times','I',8);
  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

  function headerTable(){  
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'SEMESTER:',1,0,'L'); 
        $this->Cell(130,5,'SCHOOL YEAR:',1,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'STUDENT NUMBER:',1,0,'L');
        $this->Cell(130,5,'COURSE/YEAR & SECTION:',1,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'LAST NAME:',1,0,'L');
        $this->Cell(65,5,'FIRST NAME:',1,0,'L');
        $this->Cell(65,5,'MIDDLE NAME:',1,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(195,5,'DEGREE/PROGRAM:',1,0,'L');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->SetFillColor(220,220,220);
        $this->Cell(65,5,'SUBJECT CODE - DESCRIPTION:',1,0,'C',true);
        $this->Cell(35,5,'GRADES EARNED:',1,0,'C',true);
        $this->Cell(50,5,'INSTRUCTOR:',1,0,'C',true);
        $this->Cell(45,5,'REMARKS:',1,0,'C',true);
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',8);
        $this->Cell(65,5,'',1,0,'C');
        $this->Cell(35,5,'',1,0,'C');
        $this->Cell(50,5,'',1,0,'C');
        $this->Cell(45,5,'',1,0,'C');
        $this->Ln(9);

  $this->SetFont('Arial','B',10);
  $this->Cell(0,10,'THE ABOVE-NAMED STUDENT IS CLEARED OF ALL MONEY AND PROPERTY RESPONSIBILITY IN MY OFFICE.',0,0,'L');
  $this->Ln(4);

    $this->SetFont('Arial','',8);
  $this->Cell(0,9,'(To be signed by the duly authorized representative of the respective offices.)',0,0,'C');
  $this->Ln(9);

$this->SetFont('Arial','B',8);
  $this->Cell(0,9,'            LIBRARY                             :______________                           ACADEMIC/DIRECTOR`S OFFICE            :______________ ',0,0,'L');
  $this->Ln(7);
  $this->SetFont('Arial','B',8);
  $this->Cell(0,9,'            ACCOUNTING OFFICE       :______________                          GUIDANCE & COUNSELING OFFICE        :______________ ',0,0,'L');
  $this->Ln(7);
    $this->SetFont('Arial','B',8);
  $this->Cell(0,9,'                                                                                                                 STUDENT AFFAIRS & SERVICES              :______________ ',0,0,'L');
  $this->Ln(7);

    $this->SetFont('Arial','B',10);
  $this->Cell(0,9,'NOTE:',0,0,'L');
  $this->Ln(4);
      $this->SetFont('Arial','',10);
  $this->Cell(0,9,'    *     This clearance is valid only for five (5) months.',0,0,'L');
  $this->Ln(4);
      $this->SetFont('Arial','',10);
  $this->Cell(0,9,'    *     Bring yourprevious Registration Certificate and this clearance upon cliaming your present Registration Card.',0,0,'L');
  $this->Ln(14);

 $this->SetFont('Times','',10);
  $this->Cell(0,0,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'');  
  $this->Ln(10); 
  }
  }

$pdf = new myPDF(); 
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);  
$pdf->headerTable();
$pdf->Output();
