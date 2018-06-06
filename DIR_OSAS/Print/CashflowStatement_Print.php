<?php
require('../../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
    function Header(){
        require('../../config/connection.php');
        $orgcode = $_GET['OrgCode'];

        $query = mysqli_prepare($con, "SELECT DATE_FORMAT(CURRENT_DATE, '%M %d, %Y ') AS DATEP,OrgAppProfile_NAME
        FROM t_org_for_compliance 
        INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE 
        WHERE OrgForCompliance_ORG_CODE = ? ");
        mysqli_stmt_bind_param($query, 's', $orgcode);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        while($row = mysqli_fetch_assoc($result)){
            $name = $row['OrgAppProfile_NAME'];
            $date = $row['DATEP'];

        }

        
        $picpath = '../../Avatar/'.$orgcode.'.jpg';


        if (file_exists($picpath)) {

        }
        else {
            $picpath = '../../Avatar/Default-Organization.png';
        }


        //Header Logo
        $this->Image('../../ASSETS/images/PUPLogo.png',10,6,24);
        $this->Image($picpath,182,6,24);
        // $this->Image('deped.png',162,9,22);

        //Header
        $this->SetFont('Arial','',10);
        $this->Cell(0,3,'Republic of the Philippines',0,0,'C');
        $this->Ln(5);


        $this->SetFont('Arial','',10);
        $this->Cell(0,3,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Arial','B',10);
        $this->Cell(0,3,'QUEZON CITY BRANCH',0,0,'C');
        $this->Ln(12);

        $this->SetFont('Times','B',10);
        $this->Cell(0,0,$name,0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Don Fabian St. Barangay Commonwealth, Quezon City',0,0,'C');
        $this->Ln(14);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Office of the Student Affairs and Services',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Cashflow Statement',0,0,'C');
        $this->Ln(10);


        $this->Cell(0,0,'Date: '.$date,0,0,'R');
        $this->Ln(10);

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
        $this->SetFont('Arial','',9);
        $this->SetFillColor(220,220,220);
        $this->Cell(25,10,'DATE',1,0,'C',true);
        $this->Cell(89,10,'DESCRIPTION',1,0,'C',true);
        $this->Cell(27,10,'COLLECTION',1,0,'C',true);
        $this->Cell(27,10,'EXPENSE',1,0,'C',true);
        $this->Cell(27,10,'BALANCE',1,0,'C',true);
        $this->Ln();

        require('../../config/connection.php');
        $item = '';    
        $orgCode = $_GET['OrgCode'];

        foreach (explode(',', $_GET['items']) as $data) {
            $item = $item . ",'".$data."'";
        }
        $view_query = mysqli_query($con, "SELECT OrgForCompliance_ORG_CODE as CODE,IF(OrgCashFlowStatement_COLLECTION IS NULL,
                CONCAT('Voucher Item/s: ',(SELECT GROUP_CONCAT(OrgVouchItems_ITEM_NAME SEPARATOR ', ')
                FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO=OrgCashFlowStatement_ITEM
                GROUP BY OrgVouchItems_VOUCHER_NO)),
                CONCAT('Remit Description: ',(SELECT OrgRemittance_DESC FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM ))) AS DESCRIPTION
                ,OrgCashFlowStatement_ITEM    AS REF ,
                IF(OrgCashFlowStatement_COLLECTION IS NOT NULL,CONCAT('Php ',FORMAT(OrgCashFlowStatement_COLLECTION,3)),'') AS COLLECTION
                ,IF(OrgCashFlowStatement_EXPENSES IS NOT NULL,CONCAT('Php ',FORMAT(OrgCashFlowStatement_EXPENSES,3)),'') AS EXPENSES
                ,CONCAT('Php ',FORMAT(((@exsum := @exsum + IFNull( OrgCashFlowStatement_EXPENSES,0))),3)) AS exBal
                ,CONCAT('Php ',FORMAT(((@colsum := @colsum + IFNull( OrgCashFlowStatement_COLLECTION,0))),3)) AS colBal
                ,CONCAT('Php ',FORMAT(((@balsum := @colsum - @exsum)),3)) AS BALANCE
                ,OrgCashFlowStatement_REMARKS AS REMARKS,DATE_FORMAT(OrgCashFlowStatement_DATE_ADD,'%M %d, %Y') AS DATEISSUED 
                ,CONCAT('Php ',FORMAT((SELECT IFNULL(SUM(OrgRemittance_AMOUNT),0) 
                FROM t_org_remittance 
                WHERE OrgRemittance_DISPLAY_STAT = 'Active' 
                AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE ) - (SELECT IFNULL(SUM(OrgVouchItems_AMOUNT),0) FROM `t_org_voucher_items` 
                INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
                WHERE OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND  OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active' ),3)) AS CURBAL
                ,CONCAT('Php ',FORMAT((SELECT IFNULL(SUM(OrgVouchItems_AMOUNT),0) FROM `t_org_voucher_items` 
                INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
                WHERE OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active' ),3)) AS TOTEXP,CONCAT('Php ',FORMAT((SELECT IFNULL(SUM(OrgRemittance_AMOUNT),0) FROM t_org_remittance WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE ),3)) AS TOTCOL
                ,CONCAT('Php ',FORMAT((SELECT IFNULL(SUM(OrgRemittance_AMOUNT),0) FROM t_org_remittance WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE )-(SELECT IFNULL(SUM(OrgVouchItems_AMOUNT),0) FROM `t_org_voucher_items`
                INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
                WHERE OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active'),3)
                ) AS TOTBALANCE
                FROM `t_org_cash_flow_statement`
                cross join
                (select @exsum := 0,@colsum := 0,@balsum := 0) params
                INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
                WHERE OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND 
                OrgCashFlowStatement_ID  IN ('0'".$item.") ORDER BY OrgCashFlowStatement_ID asc ");
                while($row = mysqli_fetch_assoc($view_query))
                {
                        
                    $desc = $row["DESCRIPTION"];
                    $ref = $row["REF"];
                    $col = $row["COLLECTION"];
                    $exp = $row["EXPENSES"];
                    $bal = $row["BALANCE"];
                    $rem = $row["REMARKS"];
                    $dat = $row["DATEISSUED"];
                    $code = $row["CODE"];
                    $curbal = $row["CURBAL"];
                    $totcol = $row["TOTCOL"];
                    $totexp = $row["TOTEXP"];
                    $totbal = $row["TOTBALANCE"];

                    
                    $this->Cell(25,10,$dat,1,0,'C');
                    $this->Cell(89,10,$desc,1,0,'C');
                    $this->Cell(27,10,$col,1,0,'C');
                    $this->Cell(27,10,$exp,1,0,'C');
                    $this->Cell(27,10,$bal,1,0,'C');
                    $this->Ln();
                    
                }
                $this->Cell(195,10,'SUMMARY',1,0,'C',true);
                $this->SetFillColor(220,220,220);
                $this->Ln();
        
                $this->Cell(130,20,'',1,0,'C');
                $this->Cell(65,10,'Total Collection: ' . $totcol,1,0,'C');
                $this->Ln();
        
                $this->Cell(130,1,'',0,0,'C');
                $this->Cell(65,10,'Total Expense: ' . $totexp,1,0,'C');
                $this->Ln();
        
                $this->Cell(65,5,'' ,0,0,'C');
                $this->Ln();

                $this->Cell(100,10,'' ,0,0,'C');
                $this->Cell(30,10,'Cash Left: ' ,1,0,'C',true);
                $this->SetFillColor(220,220,220);
                $this->Cell(65,10,$curbal ,1,0,'C');
                $this->Ln();
        
        
    }



}
$pdf = new myPDF();
$pdf->SetTitle('Cashflow Statment');
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);
$pdf->headerTable();
$pdf->Output();
