<?php
require('../../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
    function Header(){
  
        //Header Logo
        $this->Image('../../ASSETS/images/PUPLogo.png',10,6,18);
//        $this->Image('ASSETS/images/PUPLogo.png',186,6,18);
        
        // $this->Image('deped.png',162,9,22); 
        //Header
        $this->SetFont('Times','',10);
        $this->Cell(0,3,'                      Republic of the Philippines',0,0,'');
        $this->Ln(4);
        
        $this->SetFont('Times','',10);
        $this->Cell(0,3,'                      POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,0,'');
        $this->Ln(4);
        
        $this->SetFont('Times','',10);
        $this->Cell(0,3,'                      QUEZON CITY BRANCH',0,0,'');
        $this->Ln(3);
//        
//        $this->SetFont('Times','',8);
//        $this->Cell(0,4,'                            Damlay',0,0,'');
//        $this->Ln(4);
        
        $this->SetFont('Times','B',28);
        $this->Cell(0,0,'_______________________________________',0,0,'');  
        $this->Ln(7);
                
        $this->SetFont('Arial','B',10);
        $this->SetY(35);
        $this->Cell(0,10,'Voucher',0,0,'C');
        $this->Ln(11);
    }

// Page footer
    function Footer(){
        $this->SetFont('Times','',10);
        $this->SetXY(50,-50);
        $this->Cell(0,3,'T H I S      R E P O R T     I S     G E N E R A T E D     B Y     T H E     S Y S T E M',0,0,'');
        $this->Ln();

        $this->SetX(10);        
        $this->SetFont('Times','B',28);
        $this->Cell(0,0,'_______________________________________',0,0,'');  
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(46,-40);
        $this->Cell(0,3,'Rothlener Bldg., PUP Quezon City Branch, Don Fabian St., Commonwealth Quezon City ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(70,-35);
        $this->Cell(0,3,'Phone: (Direct Lines) 9527817; 4289144; 9577817 ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(60,-30);
        $this->Cell(0,3,'Email: commonwealth@pup.edu.ph/ Website: www.pup.edu.ph ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(85,-25);
        $this->Cell(0,3,'"The Countrys 1st Polytechnic U"',0,0,'');
        $this->Ln();
        
        $this->SetY(-20);
        $this->SetFont('Times','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        
    }

    function headerTable(){  
        require('../../config/connection.php');

        $item='';
        foreach (explode(',', $_GET['items']) as $data) {
            $item=$item . ",'".$data."'";
        }
      
      

      
        $view_query = mysqli_query($con," SELECT DATE_FORMAT(OrgVoucher_DATE_MOD,'%M %d, %Y') AS DATEISSUED ,OrgAppProfile_NAME,OrgVoucher_CHECKED_BY,OrgVoucher_VOUCHED_BY,OrgVoucher_CASH_VOUCHER_NO,(SELECT GROUP_CONCAT(OrgVouchItems_ITEM_NAME SEPARATOR ', ') 
        FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO) AS ITEMS,CONCAT('Php ',(SELECT FORMAT(SUM(OrgVouchItems_AMOUNT), 2)  
        FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO)) AS AMOUNT FROM `t_org_voucher` INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgVoucher_ORG_CODE INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE =  OrgAppProfile_APPL_CODE  WHERE OrgVoucher_ID  IN ('0'".$item.") AND OrgVoucher_STATUS = 'Approved' ");
        while($row = mysqli_fetch_assoc($view_query))
        {
            $number = $row["OrgVoucher_CASH_VOUCHER_NO"];
            $name = $row["OrgAppProfile_NAME"];
            $send = $row["OrgVoucher_VOUCHED_BY"];
            $rec = $row["OrgVoucher_CHECKED_BY"];
            $amount = $row["AMOUNT"];
            $desc = $row["ITEMS"];
            $date = $row["DATEISSUED"];
            


            $this->SetFont('Arial','B',8);
            $this->SetFillColor(220,220,220);
            $this->Cell(35,5,'VOUCHER NUMBER:',1,0,'C',true);
            $this->Cell(60,5,'ORGANIZATION:',1,0,'C',true);
            $this->Cell(60,5,'AMOUNT:',1,0,'C',true);
            $this->Cell(35,5,'DATE ISSUED:',1,0,'C',true);
            $this->Ln();            
            
            
            $this->SetFont('Arial','B',8);
            $this->Cell(35,5,$number,1,0,'C');
            $this->Cell(60,5,$name,1,0,'C');
            $this->Cell(60,5,$amount,1,0,'C');
            $this->Cell(35,5,$date,1,0,'C');
            $this->Ln();

            $this->SetFont('Arial','B',8);
            $this->SetFillColor(220,220,220);
            $this->Cell(35,5,'DESCRIPTION:',1,0,'C',true);
            $this->Cell(155,5,$desc,1,0,'C');
            $this->Ln();                    
            $this->SetFont('Arial','B',8);
            $this->SetFillColor(220,220,220);
            $this->Cell(35,5,'SEND BY:',1,0,'C',true);
            $this->Cell(155,5,$send,1,0,'C');
            $this->Ln();        
            $this->SetFont('Arial','B',8);
            $this->SetFillColor(220,220,220);
            $this->Cell(35,5,'RECEIVED BY:',1,0,'C',true);
            $this->Cell(155,5,$rec,1,0,'C');
            $this->SetAutoPageBreak(true , 80);
            $this->Ln();
            
        }

  }
  }

$pdf = new myPDF(); 
$pdf->SetTitle('Voucher'); 
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);  
$pdf->headerTable();
$pdf->Output();
